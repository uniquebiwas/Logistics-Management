<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pricing extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'agent_id',
        'country_id',
        'zone_id',
        'package_type_id',
        'serviceAgentId',
        'createdBy',
        'updatedBy',
        'publishStatus',
        'effectiveDate',
        'created_at',
    ];
    public $timestamps = true;
    protected $casts = [
        'effectiveDate' => 'datetime'
    ];
    protected $dates = ['deleted_at'];
    public function getWeightPrice()
    {
        return $this->hasMany(WeightPrice::class, 'pricing_id', 'id');
    }
    public function getCountry()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
    public function getZone()
    {
        return $this->hasOne(ShipmentZone::class, 'id', 'zone_id');
    }
    public function getAgent()
    {
        return $this->hasOne('App\Models\ServiceAgent', 'id', 'serviceAgentId');
    }
    public function getLocalAgent()
    {
        return $this->hasOne('App\Models\User', 'id', 'agent_id');
    }
    public function getAgentProfile()
    {
        return $this->hasOne('App\Models\Agent\AgentProfile', 'agent_id', 'userId');
    }
    public function getPackageType()
    {
        return $this->hasOne(ShipmentPackageType::class, 'id', 'package_type_id');
    }
}
