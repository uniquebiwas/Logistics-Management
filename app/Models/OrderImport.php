<?php

namespace App\Models;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderImport extends Model
{
    use HasFactory, SoftDeletes;
    public const STATUS = [
        1 => 'Order Imported , Waiting Allocation',
        2 => 'Order Allocation passed , however Order is Now in Hold Status for Reasons',
        3 => 'Order Ready for Dispatched',
        4 => 'Order Dispatched ',
        5 => 'Order is Not Completed',
        99 => 'Order is Canceled',
    ];
    protected $fillable = [
        'vendor',
        'shipmentId',
        'pool_id',
        'status',
        'allocated',
    ];

    protected $casts =  [
        'allocated' => 'boolean',
    ];

    public function shipment()
    {
        return $this->belongsTo(ShipmentPackage::class, 'shipmentId');
    }

    public function getClearStatusAttribute()
    {
        return self::STATUS[$this->status] ?? 'un-assigned';
    }
}
