<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightPrice extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable =
    [
        'weight',
        'price',
        'pricing_id',
    ];
    public function getPricing()
    {
        return $this->belongsTo(Pricing::class, 'id', 'pricing_id');
    }
}
