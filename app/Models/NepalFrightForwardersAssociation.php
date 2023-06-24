<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NepalFrightForwardersAssociation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'firstRow' => 'json',
        'airwayBill' => 'json',
        'optionalShippingInformation' => 'json',
        'wholeTotal' => 'json',
        'information' => 'json',
    ];
}
