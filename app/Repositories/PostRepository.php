<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Post;

class PostRepository
{
    protected const PAGE_LIMIT = 10;

    public function getPaginated(): LengthAwarePaginator
    {
        return Post::with('wpPost')->latest()->paginate(self::PAGE_LIMIT);
    }

    public function get(int $id): Post
    {
        return Post::with('wpPost')->where('id', $id)->first();
    }

    public function getBySlug(string $slug): Post
    {
        return Post::with('wpPost')->where('slug', $slug)->first();
    }

    public function getAllUrls()
    {
        return Post::with(['wpPost' => function ($query) {
            $query->select('ID', 'post_name');
        }])->get();
    }

    public function getByWpPostId(int $wpPostId, bool $incDeleted = false): Post|null
    {
        $model = $incDeleted ? Post::select('*') : Post::withTrashed();
        return $model->where('wp_post_id', $wpPostId)->first();
    }

    public function add(array $params): Post
    {
        return Post::create([
            'wp_post_id'           => $params['wp_post_id'],
            'wp_category_id'       => $params['wp_category_id'],
            'slug'                 => $params['slug']
        ]);
    }

    public function edit(int $id, array $params): bool
    {
        $post = Post::find($id);
        $post->wp_category_id       = $params['wp_category_id'];
        $post->slug                 = $params['slug'];
        return $post->save();
    }

    public function delete(int $id)
    {
        return Post::destroy($id);
    }
}