<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentCancellationReason extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'publishStatus',
        'usage_by',
        'createdBy',
        'updatedBy',
    ];
    protected $dates  = ['deleted_at'];
}
