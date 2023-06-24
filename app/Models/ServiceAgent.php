<?php

namespace App\Models;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAgent extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'publishStatus',
        'created_by',
        'updated_by',
        'api_url',
    ];
    public function shipments()
    {
        return $this->hasMany(ShipmentPackage::class, 'service_agent');
    }
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'zone_country_service_agents', 'serviceagent_id', 'country_id')->withTimestamps();
    }
}
