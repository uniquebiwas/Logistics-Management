<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserType extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'typeId',
        "verifiedAt",
        "verifiedBy",
        "workerGrade"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function userrole()
    {
        return $this->hasOne(TypeOfUser::class, 'id', 'typeId');
    }

    public function userTypeName()
    {
        return $this->belongsTo(TypeOfUser::class, 'typeId');
    }
}
