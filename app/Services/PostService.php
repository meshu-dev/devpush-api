<?php

namespace App\Services;

use App\Repositories\{PostRepository, PostCategoryRepository};
use Corcel\Model\Meta\ThumbnailMeta;

class PostService
{
    public function __construct(
        protected PostRepository $postRepository,
        protected PostCategoryRepository $postCategoryRepository
    ) { }

    public function processPost($wpPost)
    {
        $wpPostId = (int) $wpPost->ID;
        $categoryTaxonomy = $wpPost->taxonomies()->first();

        $params = [
            'wp_category_id' => $categoryTaxonomy->term->term_id ?? 0,
            'slug'           => $wpPost->slug
        ];

        $post          = $this->postRepository->getByWpPostId($wpPostId, true);
        $isPostDeleted = strpos($wpPost->slug, '__trashed') !== false;

        if ($post) {
            if ($isPostDeleted) {
                $this->postRepository->delete($post->id);
            } else {
                $this->postRepository->edit(
                    $post->id,
                    $params
                );
            }
        } else {
            $params['wp_post_id'] = $wpPostId;
            $post = $this->postRepository->add($params);

            if ($isPostDeleted) {
                $this->postRepository->delete($post->id);
            }
        }
    }

    public function processPostCategory($wpCategory)
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
}
