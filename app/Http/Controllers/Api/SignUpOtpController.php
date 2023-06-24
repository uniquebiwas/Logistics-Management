<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConsumedOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\Api\ApiSharedTrait;
use App\Traits\Api\SendSms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignUpOtpController extends Controller
{
    use ApiSharedTrait;
    use SendSms;
    public function __construct(ConsumedOtp $signupOtp)
    {
        $this->signupOtp = $signupOtp;
    }

    protected function getRules()
    {
        // check job id
        // check availibility


        return [
            "mobile" => "required|numeric|unique:users,mobile",
        ];
    }

    public function sendOtp(Request $request)
    {

        $validation = Validator::make($request->all(), $this->getRules());
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation)
            ], 422);
        }

        $mobile = $validation->validated();
        $otp = $this->getOtp();
        DB::beginTransaction();
        try {
            $data = [
                'mobile' => $mobile['mobile'],
                'otp' => Hash::make($otp),
                'purpose' => 'customer_signup',
            ];
            $this->signupOtp->create($data);
            DB::commit();
            return response()->json([
                "status" => true,
                "status_code" => 201,
                "otp" => $otp,
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
}
