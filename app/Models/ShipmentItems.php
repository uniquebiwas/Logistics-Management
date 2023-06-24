<?php

namespace App\Models;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentItems extends Model
 {
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'quantity',
        'piece_number',
        'length',
        'weight',
        'height',
        'width',
        'volume_weight',
        'barcode',
        'description',
        'shipmentPackageId',
        'isBagged',
        'package_number',
    ];
    protected $date = ['deleted_at'];

    public function shipmentPackage()
 {
        return $this->belongsTo( ShipmentPackage::class, 'shipmentPackageId' );
    }
}
