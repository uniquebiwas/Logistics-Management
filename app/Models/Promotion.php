<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Elequoent\EloquentTrait;

class Promotion extends Model
{
    use HasFactory, EloquentTrait;

    protected $fillable = [
        'title',
        'description',
        'addedBy',
        'updatedBy',
        'publishStatus',
        'image',
    ];

    protected $casts = [
        'title' => 'json',
        'description' => 'json'
    ];


}
