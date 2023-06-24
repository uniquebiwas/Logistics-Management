<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentPackageType extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_type',
        'image',
        'publishStatus',
        'created_by',
        'updated_by',
    ];

}
