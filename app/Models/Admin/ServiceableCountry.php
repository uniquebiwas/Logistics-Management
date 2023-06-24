<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceableCountry extends Model
{
    use HasFactory;
    protected $fillable = [
        'countryId'
    ];
}
