<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'description',
        'publish_status',
        'featured_status',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'title' => "json",
        'description' => "json"
    ];
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function blogs()
    {
        return $this->belongsToMany(Blog::class)->withTimestamps();
    }

    public function scopeStatus($query)
    {
        return $query->where('publish_status', '1');
    }
}
