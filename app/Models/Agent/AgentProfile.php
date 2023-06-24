<?php

namespace App\Models\Agent;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentProfile extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable  = [
        'company_name',
        'state',
        'city',
        'address',
        'designation',
        'country',
        'userId',
        'phone',
        'facebook',
        'twitter',
        'website',
        'address',
        'slug',
        'designation',
        'company_logo_url',
        'company_phone',
        'accountant_name',
        'accountant_email',
        'accountant_phone',
        'vatNumber'
    ];
    public function get_country()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }
}
