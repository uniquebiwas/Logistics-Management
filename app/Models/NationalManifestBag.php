<?php

namespace App\Models;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalManifestBag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function nationalManifest()
    {
        return $this->belongsTo(NationalManifest::class, 'manifestId');
    }

    public function shipment()
    {
        return $this->belongsToMany(ShipmentItems::class, 'national_manifest_packages', 'bagId', 'shipmentItemId');
    }

    public function getShipmentCountAttribute()
    {
        return $this->shipment()->count();
    }
}
