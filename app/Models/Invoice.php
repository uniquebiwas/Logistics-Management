<?php

namespace App\Models;

use App\Models\Agent\ShipmentPackage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;

    public const PARTICULAR = [
        '1' => ' Freight Charge',
        '2' => 'Freight Charge <br /> Weight Difference',
    ];

    public $guarded = [];

    protected $casts = [
        'paymentStatus' => 'bool',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'dueDate',
        'date'
    ];

    public function shipmentPackages()
    {

        return $this->belongsToMany(ShipmentPackage::class, 'invoice_shipments', 'invoiceId', 'shipmentId')
            ->withPivot('rates', 'weights', 'particular');
    }
    public function getPaymentTypeAttribute($value)
    {
        return ucwords($value);
    }

    public function getShipmentTotalCharge()
    {
        return DB::table('invoice_shipments')
            ->where('invoiceId', $this->referenceId ?? $this->id)
            ->get()
            ->sum(function ($query) {
                return $query->rates;
            });
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
    public function childInvoice()
    {
        return $this->hasMany(Invoice::class, 'referenceNumber')->withDefault();
    }
    public function parentInvoice()
    {
        return $this->belongsTo(Invoice::class, 'referenceNumber')->withDefault();
    }
    public function getAgent()
    {
        return $this->hasOne(User::class, 'id', 'agentId');
    }

    public function invoiceDocument()
    {
        return $this->hasMany(InvoiceDocument::class, 'invoiceId');
    }

    public function getParticular($value)
    {
        return self::PARTICULAR[$value] ?? self::PARTICULAR[1];
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

    public function setTiaChargeAttribute($value)
    {
        $this->attributes['tiaCharge'] = $value - (int) $value > 0.5 ?  ceil($value) : floor($value);
    }

    public function getBetweenAwbAttribute()
    {
        return Carbon::parse($this->shipmentPackages()->min('shipment_packages.created_at'))->format('d M') . ' - ' . Carbon::parse($this->shipmentPackages()->max('shipment_packages.created_at'))->format('d M');
    }
}
