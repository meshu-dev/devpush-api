<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Models\PostCategory;

class PostCategoryRepository
{
    public function getAll(): Collection
    {
        return PostCategory::with('wpCategory')->get();
    }

    public function getByWordpressCategoryId(int $wpCategoryId): PostCategory|null
    {
        return PostCategory::where('wp_category_id', $wpCategoryId)->first();
    }

    public function add(array $params): PostCategory
    {
        return PostCategory::create([
            'wp_category_id' => $params['wp_category_id'],
            'name'           => $params['name']
        ]);
    }

    public function edit(int $id, array $params): bool
    {
        $postCategory = PostCategory::find($id);
        $postCategory->name = $params['name'];
        return $postCategory->save();
    }
}