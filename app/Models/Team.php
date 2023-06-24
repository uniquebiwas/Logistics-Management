<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Team extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $casts = [
        'full_name' => 'array',
        'description' => 'json',
    ];
    public function setFullName()
    {
    }
    public function designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }
}
