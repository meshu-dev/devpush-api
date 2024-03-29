<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Wordpress\WpPost;
use App\Models\PostThumbnail;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'wp_post_id',
        'wp_category_id',
        'slug'
    ];

    public function wpPost(): BelongsTo
    {
        return $this->belongsTo(WpPost::class, 'wp_post_id', 'ID');
    }
}
