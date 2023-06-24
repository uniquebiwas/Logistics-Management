<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserGeoLocationController extends Controller
{
    //
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function updateGioLocation(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $user = $this->user->where('id', $user->id)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                'message' => 'Invalid credentials.'
            ], 404);
        }

        $validation = Validator::make($request->all(), [
            "currentLat" => "required|numeric ",
            "currentLng" =>  "required|numeric ",
            "currentAddress" =>  "required|string|max:150",
        ]);


        if ($validation->fails()) {
            // dd($validation);
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }
        try {
            $data = [
                "currentAddress" => $request->currentAddress,
                "currentLat" => $request->currentLat,
                "currentLng" => $request->currentLng,
            ];
            $user->fill($data)->save();
            return response()->json([
                'status' => true, 
                'status_code' => 200,
                'message' => 'Location updated successfully.'
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'status' => false,
                'status_code' => 502,
                'message' => [$error->getMessage()]
            ], 502);
        }
    }
}
