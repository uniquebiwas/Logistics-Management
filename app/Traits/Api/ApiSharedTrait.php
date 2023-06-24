<?php 
namespace App\Traits\Api;

use Illuminate\Support\Facades\Hash;

/**
 * 
 */
trait ApiSharedTrait
{
    protected $lang = 'en';
    protected function getOtp()
    {
        return rand(100000, 999999);
    }

    protected function authenticateOtp($request, $user){
        if($user && $user->userOtp ){
            return !Hash::check($request->otp, $user->userOtp->otp);
        }else {
            return true; 
        }
    }

    protected function getUser($mobile){
        return $this->user->where('mobile', $mobile)
        ->with(['userOtp' => function ($qr) {
            return $qr->where('purpose', 'customer_login')->latest();
        }, 'userCategory' => function ($qr) {
            return $qr;
        }])
        ->first();
    }
    protected function getCustomer($id, $type = 'id'){
        return $this->user->where($type, $id)
        ->with(['userOtp' => function ($qr) {
            return $qr->where('purpose', 'customer_login')->latest();
        }, 'userCategory' => function ($qr) {
            return $qr;
        }])
        ->first();
    }
     
}
