<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Customer extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            $customer->customerId = self::generateCustomerId();
        });
    }
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'customerId',
        'image',
        'mobile',
        'email',
        'state',
        'city',
        'address',
        'zipcode',
        'fax',
        'country',
        'created_by',
        'updated_by'
    ];
    protected $dates = ['deleted_at'];
    public function getCountry()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function creatorType()
    {
        return $this->creator()->userCategory()->title;
    }
    public static function generateCustomerId()
    {
        return Carbon::now()->timestamp;
    }
}
