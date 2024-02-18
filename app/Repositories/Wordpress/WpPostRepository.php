<?php

namespace App\Repositories\Wordpress;

use App\Models\Wordpress\Post;

class WpPostRepository
{
    public function getAll()
    {
        return Post::get();
    }
}