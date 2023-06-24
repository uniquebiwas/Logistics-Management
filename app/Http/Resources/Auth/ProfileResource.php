<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this->name);
        return $data = [
            'name' => $this->name[@$this->lang ?? 'en'],
            'username' => $this->username,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'referralCode' => $this->referralCode,
            'verifiedAt' => $this->userCategory->verifiedAt,
            'type' => $this->userCategory->type,
            // 'emailVerifiedAt' => $this->emailVerifiedAt,
            'isVerified' => @$this->userCategory->verifiedAt ? true : false, 
            'date_of_birth' => @$this->date_of_birth, 
            'gender' => @$this->gender, 
            'image' => $this->profileImage ?  asset("/uploads/user/$this->profileImage") : null ,
        ];
        return parent::toArray($request);
    }
}
