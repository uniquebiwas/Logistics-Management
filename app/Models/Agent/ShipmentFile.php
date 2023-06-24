<?php

namespace App\Models\Agent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipmentId',
        'agentId',
        'filepath',
    ];
}
