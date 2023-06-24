<?php

namespace App\Models;

use App\Models\Agent\AgentProfile;
use App\Notifications\ResetPasswordNotification;
use App\Utilities\LogActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'mobile',
        'password',
        'profileImage',
        'emailVerifiedAt',
        'phoneVerifiedAt',
        "documentVerifiedAt",
        'permanentAddress',
        'permanentLat',
        'permanentLng',
        'tempAddress',
        'tempLag',
        'tempLng',
        'currentAddress',
        'currentLag',
        'currentLng',
        'onlineStatus',
        'agentId',
        'accountNumber',
        'publish_status',
        'password_reset_at'
    ];
    protected $dates = ['deleted_at'];
    // protected $appends = ['profile_image'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'name' => 'json',
    ];

    public function getRules($act = 'add', $id = null)
    {
        $rules = [
            'en_name' => 'required|string|max:50',
            'email' => 'required|email:rfc,dns|unique:users,email',
            // 'mobile' => 'required|numeric|numeric|unique:users,mobile,'.$id,
            'password' => 'required|string|min:8|confirmed',
            'publish_status' => 'required|in:1,0',
            'roles' => 'required',
        ];
        if ($act == 'update') {
            $rules['password'] = 'nullable|string|min:8|confirmed';
            $rules['email'] = 'nullable|email';
        }
        return $rules;
    }

    public function regex()
    {
        return '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
    }
    public function has_profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }
    // public function getProfileImageAttribute()
    // {
    //     return optional($this->has_profile)->img_path;
    // }
    public function agent_profile()
    {
        return $this->belongsTo(AgentProfile::class, 'id', 'userId')->withDefault();
    }

    public function sendPasswordResetNotification($token)
    {
        LogActivity::addToLog(request()->email . ' Requested for password ResetLink');
        $this->notify(new ResetPasswordNotification($token, request()->email));
    }





    public function userCategory()
    {
        return $this->hasOne(UserType::class, 'userId', 'id');
    }


    // public function userType(){
    //     return $this->hasManyThrough(TypeOfUser::class, UserType::class, 'id', 'userId');
    // }
    public function userOtp()
    {
        return $this->hasOne(ConsumedOtp::class, 'userId', 'id');
    }

    public function agent()
    {
        return $this->userCategory()->whereHas('userTypeName', function ($query) {
            return $query->where('title', 'agent')->limit(1);
        });
    }
    public function admin()
    {
        return $this->userCategory()->whereHas('userTypeName', function ($query) {
            return $query->where('title', 'admin')->limit(1);
        });
    }
    public function userWallet()
    {
        return $this->hasOne(AgentWalletBalance::class, 'agentId', 'id');
    }

    public function userCredit()
    {
        return $this->hasOne(Credit::class, 'agentId');
    }

    public function getIsAgentAttribute()
    {
        return DB::table('user_types')->where('userId', $this->id)->whereIn('typeId', [2])->count() == 1;
    }
}
