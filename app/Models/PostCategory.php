<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Wordpress\WpTerm;

class PostCategory extends Model
{
    protected $table = 'post_categories';

    protected $fillable = [
        'wp_category_id',
        'name'
    ];

    public $timestamps = false;

    public function wpCategory(): BelongsTo
    {
        return $this->belongsTo(WpTerm::class, 'wp_category_id', 'term_id');
    }
}
