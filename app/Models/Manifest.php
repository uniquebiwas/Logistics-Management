<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agent\ShipmentPackage;

class Manifest extends Model
{
    use HasFactory;
    protected $fillable = [
        'manifest_number',
        'flightNumber',
        'shipper',
        'destination',
        'date',
        'masterAirwayBill',
        'client',
        'clientLocation',
        'airlines',
        'remarks'
    ];

    public $casts = [
        'date' => 'date'
    ];
    public function getShipper()
    {
        return $this->belongsTo(User::class, 'shipper');
    }

    public function shipment()
    {
        return $this->belongsToMany(ShipmentPackage::class, 'manifest_shipments', 'manifestId', 'shipmentId')->withTimestamps();
    }

    public function bag()
    {
        return $this->hasMany(NationalManifestBag::class, 'manifestId');
    }
    protected static function generateManifestNumber()
    {
        $latest = static::selectRaw('REPLACE(manifest_number,"ALGINTL-","") as manifest')
            ->where('manifest_number', '<>', null)
            ->orderBy('id', 'desc')->first();

        if (empty($latest->manifest)) {
            return 'ALGINTL-' . 1000;
        }
        return 'ALGINTL-' . ((int)$latest->manifest + 1);
    }
}
