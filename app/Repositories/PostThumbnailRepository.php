<?php

namespace App\Repositories;

use App\Models\PostThumbnail;

class PostThumbnailRepository
{
    public function getByWpFeaturedMediaId(int $wpFeaturedMediaId): PostThumbnail|null
    {
        return PostThumbnail::where('wp_featured_media_id', $wpFeaturedMediaId)->first();
    }

    public function add(array $params): PostThumbnail
    {
        return PostThumbnail::create([
            'wp_featured_media_id' => $params['wp_featured_media_id'],
            'source_image_url'     => $params['source_image_url'],
            'sizes'                => $params['sizes'],
            'created_at'           => $params['created_at'],
            'updated_at'           => $params['updated_at']
        ]);
    }

    public function edit(int $id, array $params): bool
    {
        $postThumbnail = PostThumbnail::find($id);
        $postThumbnail->wp_featured_media_id = $params['wp_featured_media_id'];
        $postThumbnail->source_image_url     = $params['source_image_url'];
        $postThumbnail->sizes                = $params['sizes'];
        $postThumbnail->created_at           = $params['created_at'];
        $postThumbnail->updated_at           = $params['updated_at'];
        return $postThumbnail->save();
    }
}