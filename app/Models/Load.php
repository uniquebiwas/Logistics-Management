<?php

namespace App\Models;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    use HasFactory;
    protected $fillable = ['loadDate'];

    protected $casts = [
        'loadDate' => 'date',
    ];
    public function shipments()
    {
        return $this->belongsToMany(ShipmentPackage::class, 'load_shipments', 'loadId', 'shipmentId')->withTimestamps();
    }
}
