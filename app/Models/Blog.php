<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'summary',
        'description',
        'tags',
        'thumbnail',
        'external_url',
        'path',
        'slug',
        'featured_img',
        'parallex_img',
        'code',
        'publish_status',
        'postType',
        'view_count',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'meta_keyphrase',
        'created_by',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date',
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

    public function writer()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function scopeStatus($query)
    {
        return $query->where('publish_status', '1');
    }
}
