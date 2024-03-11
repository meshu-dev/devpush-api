<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Post;

class PostRepository
{
    protected const PAGE_LIMIT = 10;

    public function getPaginated(): LengthAwarePaginator
    {
        return Post::with('wpPost')->paginate(self::PAGE_LIMIT);
    }

    public function get(int $id): Post
    {
        return Post::with('wpPost')->where('id', $id)->first();
    }

    public function getAllUrls()
    {
        return Post::with(['wpPost' => function ($query) {
            $query->select('ID', 'post_name');
        }])->get();
    }

    public function getByWordpressPostId(int $wordpressPostId): Post|null
    {
        return Post::where('wp_post_id', $wordpressPostId)->first();
    }

    public function add(array $params): Post
    {
        return Post::create([
            'wp_category_id' => $params['wp_category_id'],
            'wp_post_id'       => $params['wp_post_id'],
            'name'             => $params['name'],
            'created_at'       => $params['created_at'],
            'updated_at'       => $params['updated_at']
        ]);
    }

    public function edit(int $id, array $params): bool
    {
        $post = Post::find($id);
        $post->wp_category_id = $params['wp_category_id'];
        $post->name             = $params['name'];
        $post->created_at       = $params['created_at'];
        $post->updated_at       = $params['updated_at'];
        return $post->save();
    }
}