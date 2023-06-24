<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportShipmentPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'shipment_ids',
        'from',
        'to'
    ];
    protected $casts = [
        'shipment_ids' => 'json',
    ];
}
