<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoInvoice extends Model
{
    use HasFactory;

    public const PARTICULAR = [
        'freight charge',
    ];
    public const SERVICES = [
        'air cargo', 'land/sea cargo', 'air/sea cargo', 'road service', 'freight & delivery','Express Courier'
    ];
    protected $guarded = [];

    public $casts = [
        'dueDate' => 'datetime',
        'date' => 'datetime',
    ];

    public function awbs()
    {
        return $this->hasMany(CargoInvoiceAwb::class, 'invoice_id');
    }

    public function getWholeTotalAttribute()
    {
        return $this->fuelCharge +
            $this->tiaCharge +
            $this->shipmentPackageCharge +
            $this->perPackageCharge +
            $this->insuranceCharge +
            $this->roundOff +
            $this->weightDifferenceCharge  +
            $this->fumigationCharge  +
            $this->cargoLoadingCharge  +
            $this->goodsPickupCharge +
            $this->detentionCharge +
            $this->surcharge  +
            $this->demurrage +
            $this->documentationHandlingCharge +
            $this->shipmentHandelingCharge +
            $this->customClearingCharge +
            $this->oversizeCharge +
            $this->overweightCharge +
            $this->remoteareaDeliveryCharge;
    }

    public function changePaymentStatus()
    {
        $this->paymentStatus = true;
        $this->save();
    }

    public function getStatusAttribute()
    {
        if ($this->paymentStatus) {
            return 'paid';
        }
        return 'unpaid';
    }
    public Static function getServices($value)
    {
        return self::SERVICES[$value] ?? self::SERVICES[1];
    }
}
