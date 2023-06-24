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

class NotificationListController extends Controller
{
    //

    public function __construct(User $user)
    {
        $this->user = $user;
    }



    public function allNotifications(Request $request)
    {
        $user = auth()->user();
        $user = $this->user->where('id', $user->id)->with('userCategory')->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                'message' => ["User not found."],
            ], 404);
        }
        try {
            $notifications = $this->getNotifications($request, $user);
            return response()->json(
                array_merge([
                    'status' => true,
                    'message' => "Notification fetched successfully",
                    'status_code' => 200,
                ], $notifications)
            );
        } catch (Exception $error) {
            return response()->json([
                'status' => false,
                'status_code' => 501,
                'message' => [$error->getMessage()],
            ], 501);
        }
    }

    protected function getNotifications($request, $user)
    {
        $limit = 5;
        if ($request->limit && $request->limit > 0 && $request->limit < 10) {
            $limit = $request->limit;
        }
        if ($user->userCategory->type == 'customer') {
            $notifications =   CustomerNotification::where("recieverId")
                ->when($request->search, function ($qr) use ($request) {
                    return $qr->where('title', 'like', "%$request->search%")
                        ->orWhere('description', 'like', "%$request->search%");
                })
                ->with(['sender:id,name', 'admin:id,name'])
                ->orderBy('id', 'DESC')
                ->paginate($limit);
        }

        if ($user->userCategory->type == 'agent') {
            $notifications =   AgentNotification::where("recieverId")
                ->when($request->search, function ($qr) use ($request) {
                    return $qr->where('title', 'like', "%$request->search%")
                        ->orWhere('description', 'like', "%$request->search%");
                })
                ->with(['sender:id,name', 'admin:id,name'])
                ->orderBy('id', 'DESC')
                ->paginate($limit);
        }
        if ($user->userCategory->type == 'worker') {
            $notifications =   WorkerNotification::where("recieverId")
                ->when($request->search, function ($qr) use ($request) {
                    return $qr->where('title', 'like', "%$request->search%")
                        ->orWhere('description', 'like', "%$request->search%");
                })
                ->with(['sender:id,name', 'admin:id,name'])
                ->orderBy('id', 'DESC')
                ->paginate($limit);
        }
        if ($user->userCategory->type == 'wholesaler') {
            $notifications =   WholesalerNotification::where("recieverId")
                ->when($request->search, function ($qr) use ($request) {
                    return $qr->where('title', 'like', "%$request->search%")
                        ->orWhere('description', 'like', "%$request->search%");
                })
                ->with(['sender:id,name', 'admin:id,name'])
                ->orderBy('id', 'DESC')
                ->paginate($limit);
        }

        $notificationItems = [];
        foreach ($notifications as $notificationdata) {
            $notificationItems[]  = [
                'id' => $notificationdata->title,
                'description' => $notificationdata->description,
                'date' =>  ReadableDate($notificationdata->created_at, 'all'),
                'senderName' => $notificationdata->senderId ? @$notificationdata->sender->name['en']   : ($notificationdata->adminId ? $notificationdata->admin->name : null)
            ];
            if (!$notificationdata->seen_at) {
                $notificationdata->seen_at = now();
                $notificationdata->save();
            }
        }
        $notifications = mapPageItems($notifications, 'notifications');
        $notifications['notifications'] = $notificationItems ?? null;
        return $notifications;
    }
}
