<?php

namespace App\Models;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentLocation extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = ['date' => 'immutable_datetime'];

    public function shipmentPackage()
    {
        return $this->belongsTo(shipmentPackage::class, 'shipmentId');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }
    public function getStatusLevel()
    {
        return $this->hasOne(StatusLevel::class, 'id', 'statusId');
    }
    public function getlocation()
    {
        return $this->hasOne(Location::class, 'id', 'location');
    }
}
