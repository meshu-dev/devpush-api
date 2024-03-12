<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Wordpress\WpPost;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'wp_category_id',
        'wp_post_id',
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
