<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\ConsumedOtp;
use App\Models\User;
use App\Traits\Api\ApiSharedTrait;
use App\Traits\Api\SendSms;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SendMobileOtpController extends Controller
{
    //
    use SendSms;
    use ApiSharedTrait;
    public function __construct(User $user, ConsumedOtp $otp)
    {
        $this->user = $user;
        $this->otp = $otp;
    }
    public function sendMobileVerifyOtp(Request $request)
    {
        $user = auth()->user();
        $user = $this->user->where('id', $user->id)
            ->with([
                'userOtp' => function ($qr) {
                    return $qr->where('purpose', 'verify_mobile')->latest();
                }
            ])
            ->first();
        if (!$user) {
            abort(404, 'Unauthorized access.');
        }

        // if($user->userOtp  && now()->diffInSeconds($user->userOtp->created_at) < ){

        // }
        try {
            DB::beginTransaction();
            if ($request->otp) {
                $get_otp = $this->otp
                    ->where('purpose', 'verify_mobile')
                    ->where('userId', $user->id)
                    ->latest()
                    ->first();
                if (!$get_otp) {
                    abort(501, "Invalid OTP.");
                }
                if (!Hash::check($request->otp, $get_otp->otp)) {
                    abort(501, "Invalid OTP or OTP expired.");
                }

                $user->phoneVerifiedAt = now();
                $user->save();
                $get_otp = $this->otp
                    ->where('userId', $user->id)
                    ->where('purpose', 'verify_mobile')
                    ->delete();
                DB::commit();
                $request->session()->flash('success', 'Your mobile number has been successfully verified.');
                return redirect()->route('agent');
            }
            $otp = $this->getOtp(); // 6 digits otp generator;
            $response = $this->sendSMS($user->mobile, $otp);
            if ($response != 200) {
                abort(502, 'There was a Problem While Sending OTP.');
            }
            $otp_data = [
                'userId' => $user->id,
                'otp' => Hash::make($otp),
                'purpose' => 'verify_mobile',
            ];
            $this->otp->create($otp_data);
            DB::commit();
            $request->session()->flash('success', 'An OTP has been sent to your mobile.');
            return redirect()->route('agent', ['verify_otp' => 1]);
        } catch (Exception $error) {
            DB::rollback();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }



        // dd($user);


        // $user->userOtp()


    }
}
