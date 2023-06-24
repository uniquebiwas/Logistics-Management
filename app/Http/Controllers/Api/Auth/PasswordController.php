<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\ConsumedOtp;
use App\Models\User;
use App\Models\UserType;
use App\Traits\Api\ApiSharedTrait;
use App\Traits\Api\SendSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    //
    use ApiSharedTrait;
    use SendSms;
    public function __construct(User $user, ConsumedOtp $otp, UserType $user_types)
    {
        $this->user = $user;
        $this->otp = $otp;
        $this->user_types = $user_types;
    }
    public function forgotPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'mobile' => 'required|numeric|exists:users,mobile',
        ]);
        if ($validation->fails()) {
            // dd($validation);
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }

        $user = User::where('mobile', $request->mobile)
        // ->where('status', 1)
            ->with(['userCategory', 'userOtp' => function ($qr) {
                return $qr->where('purpose', 'forget_password');
            }])
            ->first();
        if ($user->userCategory->type == 'customer') {
            return response()->json([
                'status' => false,
                'status_code' => 403,
                'message' => ['You do not have permission to access here.'],
            ], 403);
        }
        if (!$user) {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                "message" => ['Invalid credentials.'],
            ], 404);
        }

        if ($user) {
            if (@$user->userOtp->created_at && now()->diffInMinutes(@$user->userOtp->created_at) < 10) {
                return response()->json([
                    "stutus" => false,
                    "status_code" => 422,
                    'message' => ['OTP Already send your mobile Please try after 2 minutes.'],
                ], 422);
            }
        }
        $otp = $this->getOtp();
        DB::beginTransaction();
        try {
            $data = [
                'userId' => $user->id,
                'otp' => Hash::make($otp),
                'purpose' => 'forget_password',
            ];
            $response = $this->sendSMS($user->mobile, $otp);
            // dd($response->getMessage());
            if ($response != 200) {
                // dd($response);
                // $error = json_decode($response);
                // dd($error);
                abort(502,  'There was a Problem While Sending SMS');
            }
            $this->otp->create($data);
            DB::commit();
            return response()->json([
                "status" => true,
                "status_code" => 201,
                'message' => 'OTP has been sent to your mobile',
            ], 201);

        } catch (\Exception $error) {
            DB::rollback();
            return response()->json([
                "status" => false,
                "status_code" => 502,
                'message' => [$error->getMessage()],
            ], 502);
        }
    }

    /**
     * Request password change after requesting forgot password
     *
     * @param Request $request
     * @return void
     */
    public function resetPassword(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'mobile' => 'required|numeric|numeric|exists:users,mobile',
            'otp' => 'required|digits:6|numeric',
            "password" => "required|string|min:8|max:32|confirmed",
        ]);
        if ($validation->fails()) {
            // dd($validation);
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }
        // dd($request->all());
        $user = $this->user->where('mobile', $request->mobile)
            ->with(['userOtp' => function ($qr) {
                return $qr->where('purpose', 'forget_password')->latest();
            }, 'userCategory' => function ($qr) {
                return $qr;
            }])
            ->first();
        if ($user->userCategory->type == 'customer') {
            return response()->json([
                'status' => false,
                'status_code' => 403,
                'message' => ['You do not have permission to access here.'],
            ], 403);
        }

        if (!$user || $this->authenticateOtp($request, $user)) {
            return response()->json([
                'status' => false,
                'status_code' => 401,
                'message' => ['These credentials do not match our records'],
            ], 401);
        }
        if (now()->diffInMinutes($user->otp_created_at) > 10) {
            return response()->json([
                'status' => false,
                'status_code' => 422,
                'message' => 'OTP has Expired.',
            ], 422);
        }
        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => false,
                'status_code' => 422,
                'message' => ['You already have used this password in your history.'],
            ], 422);
        }
        // dd(Hash::make($request->password));
        DB::beginTransaction();
        try {

            $data['password'] = Hash::make($request->password);
            $user->fill($data)->save();
            $this->otp->where('userId', $user->id)->where('purpose', 'forget_password')->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'status_code' => 200,
                "message" => 'Password updated successfully.',
            ]);
        } catch (\Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'status_code' => 502,
                "message" => [$error->getMessage()],
            ], 502);
        }
    }

    /**
     * Request Change password  while rider is logged in
     *
     * @param Request $request
     * @return void
     */
    public function changePassword(Request $request)
    {
        // dd(auth()->user());
        $validation = Validator::make($request->all(), [
            'old_password' => 'required|string',
            "password" => "required|string|min:8|max:32|confirmed",
        ]);
        if ($validation->fails()) {
            // dd($validation);
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }
        $auth_user = $request->user();
        $user = $this->getUser($auth_user->mobile);
        // dd($user);
        if (!$user) {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                "message" => ['User information not found.'],

            ], 404);
        }
        if ($user->userCategory->type == 'customer') {
            return response()->json([
                'status' => false,
                "status_code" => 403,
                "message" => ['Unauthorized access.'],
            ], 403);
        }
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                "status" => false,
                'status_code' => 422,
                'message' => ['Old password does not match'],
            ], 422);
        }
        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => false,
                'status_code' => 422,
                'message' => ['You already have used this password in your history.'],
            ], 422);
        }

        $user->password = Hash::make($request->password);
        try {
            $user->save();
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => "Your password successfully changed.",
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status' => false,
                'status_code' => 502,
                'message' => [$error->getMessage()],
            ], 502);
        }
    }
}
