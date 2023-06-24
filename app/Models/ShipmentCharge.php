<?php

namespace App\Models;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentCharge extends Model
{
    use HasFactory;

    public const CURRENCYTYPE = [
        'DOLLAR' => 'USD',
        'EURO' => 'euro',
        'POUND' => 'Pound'
    ];
    protected $fillable = [
        'shipmentId',
        'shipping_charge',
        'service_charge',
        'service_agent_charge',
        'tiaCharge',
        'tiaCalculatedCharge',
        'handling',
        'handlingCalculated',
        'billing',
        'billingCalculated',
        'packaging',
        'gov_tax',
        'agentId',
        'currency_type',
        'total'
    ];


    public function shipmentPackage()
    {
        return $this->belongsTo(ShipmentPackage::class, 'shipmentId');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agentId');
    }

    public function setTiaCalculatedChargeAttribute($value)
    {
        $this->attributes['TiaCalculatedCharge'] = $value - (int) $value > 0.5 ?  ceil($value) : floor($value);
    }
    public function setHandlingCalculatedAttribute($value)
    {
        $this->attributes['handlingCalculated'] = $value - (int) $value > 0.5 ?  ceil($value) : floor($value);
    }

    public function setBillingCalculatedAttribute($value)
    {
        $this->attributes['billingCalculated'] = $value - (int) $value > 0.5 ?  ceil($value) : floor($value);
    }

    public function getBillingTotalAttribute()
    {
        if ($this->billingCalculated > 0) {
            return $this->tiaCalculatedCharge +  $this->handlingCalculated + $this->billingCalculated + $this->packaging;
        }
        return $this->tiaCalculatedCharge +  $this->handlingCalculated + $this->total + $this->packaging;
    }
}
