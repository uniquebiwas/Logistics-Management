<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipPackage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'image_url',
        'package_amount',
        'yearly_max_request',
        'description',
        'addedBy',
        'updatedBy',
        'publishStatus',
    ];
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    protected $casts = [
        'title' => "json",
        'summary' => "json",
        'description' => "json",
        'tags' => "json",
    ];
}
