<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'position',
        'oldId',
        'isOldData',
        'publish_status',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];

}
