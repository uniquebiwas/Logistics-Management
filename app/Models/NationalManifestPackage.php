<?php

namespace App\Models;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalManifestPackage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function shipmentPackage()
    {
        return $this->belongsTo(ShipmentPackage::class, 'shipmentId');
    }
}
