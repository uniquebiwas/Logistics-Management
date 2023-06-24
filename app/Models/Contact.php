<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'oldId',
        'isOldData',
        'message',
        'service',
        'view_status'
    ];
    public function getService()
    {
        return $this->hasOne('App\Models\ServiceCategory', 'id', 'service');
    }
}
