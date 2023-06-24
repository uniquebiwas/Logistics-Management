<?php

namespace App\Models;

use App\Models\News;
use App\Models\AdvertisementPosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'content',
        'slug',
        "oldId",
        'external_url',
        'position',
        "side_position",
        'parent_id',
        'publish_status',
        'short_description',
        'description',
        'featured_img',
        'parallex_img',
        'created_by',
        'updated_by',
        'meta_title',
        'meta_keyword',
        'meta_description',
        "meta_keyphrase",
        "featured_img_path",
        "parallex_img_path",
        "content_type",
        "show_on",
        "oldId",
        "isOldData",
        "news_section",
        "featured_img_url",
        "parallex_img_url",
    ];
    protected $casts = [
        'title' => "json",
        'short_description' => "json",
        'description' => "json",
        'show_on' => "array",
    ];
    protected $dates = ['deleted_at'];
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function child_menu()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id', 'id')->orderby('position', 'asc');
    }

    public function getRules($act = 'add', $id = null)
    {
        $rules = [
            'title' => 'required|string',
            'slug' => 'required|unique:menus,slug|string',
            'status' => 'required|in:active,inactive',
            'publish_status' => 'required|in:1,0',
        ];
        if ($act == 'update') {
            $rules['slug'] = 'nullable|string|unique:menus,slug,' . $id;
        }
        return $rules;
    }
    public function setCategory()
    {
        return json_decode($this->id, true);
    }
    public function regex()
    {
        return '/^[a-zA-Z0-9](.*[a-zA-Z0-9])?$/';
    }
}
