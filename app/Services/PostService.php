<?php

namespace App\Services;

use App\Repositories\{PostRepository, PostCategoryRepository, PostThumbnailRepository};
use Corcel\Model\Meta\ThumbnailMeta;

class PostService
{
    public function __construct(
        protected PostRepository $postRepository,
        protected PostCategoryRepository $postCategoryRepository,
        protected PostThumbnailRepository $postThumbnailRepository
    ) { }

    public function upsertPost($wpPost)
    {
        $wpPostId = (int) $wpPost->ID;
        $categoryTaxonomy = $wpPost->taxonomies()->first();
        $wpFeaturedMediaId = $wpPost->thumbnail !== null ? $wpPost->thumbnail->meta_value : 0;

        $params = [
            'wp_category_id'       => $categoryTaxonomy->term->term_id ?? 0,
            'slug'                 => $wpPost->slug,
            'created_at'           => $wpPost->post_date,
            'updated_at'           => $wpPost->post_modified
        ];

        $post = $this->postRepository->getByWpPostId($wpPostId);

        if ($post) {
            $this->postRepository->edit(
                $post->id,
                $params
            );
        } else {
            $params['wp_post_id'] = $wpPostId;
            $this->postRepository->add($params);
        }
    }

    public function upsertPostCategory($wpCategory)
    {
        $wpCategoryId = (int) $wpCategory->term_id;
        $postCategory = $this->postCategoryRepository->getByWordpressCategoryId($wpCategoryId);
        $params       = ['name' => $wpCategory->name];

        if ($postCategory) {
            $this->postCategoryRepository->edit(
                $postCategory->id,
                $params
            );
        } else {
            $params['wp_category_id'] = $wpCategoryId;
            $this->postCategoryRepository->add($params);
        }
    }

    public function upsertPostThumbnail($wpPost)
    {
        if ($wpPost->thumbnail !== null) {
            $corcelThumbnail  = $wpPost->thumbnail;
            $wpFeaturedMediaId = $corcelThumbnail->meta_value;

            $postThumbnail = $this->postThumbnailRepository->getByWpFeaturedMediaId($wpFeaturedMediaId);

            $corcelAttachment = $corcelThumbnail?->attachment;

            $sizes   = [];
            $sizes[] = $corcelThumbnail->size(ThumbnailMeta::SIZE_THUMBNAIL);
            $sizes[] = $corcelThumbnail->size(ThumbnailMeta::SIZE_MEDIUM);
            $sizes[] = $corcelThumbnail->size(ThumbnailMeta::SIZE_LARGE);
            $sizes[] = $corcelThumbnail->size(ThumbnailMeta::SIZE_FULL);

            $params = [
                'source_image_url'     => $corcelAttachment->guid,
                'sizes'                => $sizes,
                'created_at'           => $corcelAttachment->post_date,
                'updated_at'           => $corcelAttachment->post_modified
            ];

            if ($postThumbnail) {
                $this->postThumbnailRepository->edit($postThumbnail->id, $params);
            } else {
                $params['wp_featured_media_id'] = $wpFeaturedMediaId;
                $this->postThumbnailRepository->add($params);
            }
        }
    }
}
