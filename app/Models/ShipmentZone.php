<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentZone extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'publishStatus',
        'serviceAgentId',
        'position',
        'createdBy',
        'updatedBy',
    ];

    public function serviceAgent()
    {
        return $this->belongsTo(ServiceAgent::class, 'serviceAgentId');
    }
}
