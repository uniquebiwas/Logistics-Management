<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumedOtp extends Model
{
    use HasFactory;
    protected $fillable = [
        "userId",
        "otp",
        "purpose",
        "mobile",
        "token"
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
