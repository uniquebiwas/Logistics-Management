<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\ProfileResource;
use App\Models\ConsumedOtp;
use App\Models\User;
use App\Models\UserType;
use App\Traits\Api\ApiSharedTrait;
use App\Traits\Api\SendSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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
    public function profile(Request $request)
    {
        $user = auth()->user();
        try {
            $user = $this->user->where('id', $user->id)->first();

            $data = new ProfileResource($user);
            return response()->json([
                'status' => true,
                'profile' => $data,
                'status_code' => 200,
            ], 200);

        } catch (\Exception $error) {
            return response()->json([
                'status' => false,
                'profile' => $user,
                'status_code' => 502,
                "message" => [$error->getMessage()],
            ], 502);
        }

    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        // dd(auth()->user());
        $user = auth()->user();
        $user = $this->user->where('id', $user->id)->first();
        // dd($user);
        $validation = Validator::make($request->all(), [
            "mobile" => "required|string|numeric|unique:users,mobile," . @$user->id,
            "email" => "nullable|email|unique:users,email," . @$user->id,
            "isNumberChanged" => "nullable|boolean",
            "otp" => "required_if:isNumberChanged,true|digits:6",
            'name' => 'required|string|min:3|max:100',
            // "password" => "required|string|min:8",
            "gender" => "required|string|in:male,female,other",
            "dateOfBirth" => "required|date_format:Y-m-d",
            'photo' => 'sometimes|image|max:1024|mimes:png,jpg,gif,tif,jpeg,tiff', // required on live mode
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

        if ($request->isNumberChanged) {
            // $otp = $request->otp;
            $otpInfo = $this->otp->where('userId', $user->id)
                ->where('mobile', $request->mobile)
                ->where('purpose', 'update_profile')
                ->first();
            if (!$otpInfo) {
                return response()
                    ->json([
                        'status' => false,
                        'status_code' => 404,
                        'message' => ["Invalid OTP."],
                    ], 404);
            }

            if (!Hash::check($request->otp, $otpInfo->otp)) {
                return response()->json([
                    "status" => false,
                    "status_code" => 401,
                    'message' => ['Inavalid mobile number or otp'],
                ], 401);
            }
        }

        $data = [
            "name" => [
                'np' => $request->name,
                'en' => $request->name,
            ],
            "email" => $request->email,
            "mobile" => $request->mobile,
            "gender" => $request->gender,
            "dateOfBirth" => $request->dateOfBirth,
        ];

        DB::beginTransaction();
        try {
            $user->fill($data)->save();
            if ($request->isNumberChanged) {
                if ($user->mobile != $request->mobile) {
                    $user->update(['mobile' => $request->mobile]);
                }
            }
            $this->otp->where('userId', $user->id)
                ->where('purpose', 'update_profile')
                ->delete();
            if ($request->photo) {
                $photo = uploadFile($request->photo, 'uploads/user', false, $user->mobile);
                if ($photo) {
                    $data['profileImage'] = $photo;
                    deleteFile(@$user->profileImage, 'uploads/user', false);
                }
            }

            $user->fill($data)->save();
            DB::commit();
            return response()->json([
                'status' => true,
                "status_code" => 200,
                'message' => "Profile updated successfully.",
                'data' => new ProfileResource($user),
            ], 200);
        } catch (\Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => [$error->getMessage()],
            ]);
        }
    }

    public function updateProfileImage(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'photo' => 'required|image|max:1024|mimes:png,jpg,gif,tif,jpeg,tiff',
        ]);
        if ($validation->fails()) {
            // dd($validation);
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }
        $user = User::where('id', $request->user()->id)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                'message' => ['Invalid credential.'],
            ], 404);
        }

        DB::beginTransaction();
        try {
            if ($request->photo) {
                $photo = uploadFile($request->photo, 'uploads/user', false, $user->mobile);
                if ($photo) {
                    $data['profileImage'] = $photo;
                    deleteFile(@$user->profileImage, 'uploads/user', false);
                }
            }
            $status = $user->fill($data)->save();
            DB::commit();
            $userInfo = $this->user->where('id', $request->user()->id)->first();

            // dd($userInfo);
            // dd($userInfo->profileImage);
            return response()->json([
                'photo' => $userInfo->profileImage ? asset("uploads/user/$userInfo->profileImage") : null,
                'message' => 'Profile Image Uploaded',
                "status" => true,
                'status_code' => 201,
            ], 201);
        } catch (\Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => false,
                "status_code" => 502,
                "message" => [$error->getMessage()],

            ], 502);
        }
    }
}
