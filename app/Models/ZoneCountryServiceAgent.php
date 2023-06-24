<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneCountryServiceAgent extends Model
{
    use HasFactory;
    protected $fillable = [
        'zone_id',
        'agentId',
        'serviceagent_id',
        'country_id',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
