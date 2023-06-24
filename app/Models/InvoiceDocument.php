<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDocument extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'verifiedAt' => 'datetime',
        'status' => 'bool',
    ];
}
