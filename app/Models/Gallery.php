<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'featured_img',
        'created_by',
        'publish_status',
        'slug',
    ];

    public function galleryImage()
    {
        return $this->hasMany(GalleryImage::class, 'galleryId', 'id');
    }
}
