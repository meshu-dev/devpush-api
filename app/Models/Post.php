<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Wordpress\WpPost;
use App\Models\PostThumbnail;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'wp_post_id',
        'wp_category_id',
        'slug',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;

    public function wpPost(): BelongsTo
    {
        return $this->belongsTo(WpPost::class, 'wp_post_id', 'ID');
    }
}
