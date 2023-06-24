<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgentNotification;
use App\Models\CustomerNotification;
use App\Models\User;
use App\Models\WholesalerNotification;
use App\Models\WorkerNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemoveNotificationController extends Controller
{
    //

    public function __invoke(Request $request, $notificationId)
    {
        $user = auth()->user();
        $user =  User::where('id', $user->id)->with('userCategory')->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                'message' => ['User not found.'],
            ], 404);
        }
        DB::beginTransaction();
        try {
            $notification = null;
            if ($user->userCategory->type == 'customer') {
                $notification = CustomerNotification::where('id', $notificationId)->where('recieverId', $user->id)->first();
            }
            if ($user->userCategory->type == 'worker') {
                $notification = WorkerNotification::where('id', $notificationId)->where('recieverId', $user->id)->first();
            }
            if ($user->userCategory->type == 'agent') {
                $notification = AgentNotification::where('id', $notificationId)->where('recieverId', $user->id)->first();
            }
            if ($user->userCategory->type == 'wholesaler') {
                $notification = WholesalerNotification::where('id', $notificationId)->where('recieverId', $user->id)->first();
            }
            if (!$notification) {
                return response()->json([
                    'status' => false,
                    'status_code' => 404,
                    'message' => ["You are trying to remove unavailable notification"],

                ], 404);
            }

            $notification->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => "Notification successfully removed.",
            ], 200);
        } catch (Exception $error) {
            // dd($error);
            DB::rollback();
            return response()->json([
                'status' => false,
                'status_code' => 502,
                'message' => [$error->getMessage()],

            ], 502);
        }


        // dd($notificationId);

    }
}
