<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminNotification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'senderId',
        'recieverId',
        'seen_at',
        'firebaseMessageId',
    ];

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'senderId');
    }
    public function reciever()
    {
        return $this->hasOne(Admin::class, 'id', 'recieverId');
    }

}
