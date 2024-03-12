<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostThumbnail extends Model
{
    protected $table = 'post_thumbnails';

    protected $casts = ['sizes' => 'array'];

    protected $fillable = [
        'wp_featured_media_id',
        'source_image_url',
        'sizes',
        'created_at',
        'updated_at'
    ];
}
