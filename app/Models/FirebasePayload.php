<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FirebasePayload extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable  = [
        'adminId' ,
        'senderId' ,
        'receiverId' ,
        'messageId' ,

    ];
   
    protected $dates  = ['deleted_at'];
}
