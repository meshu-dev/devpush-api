<?php

namespace App\Actions;

use App\Repositories\{PostRepository, PostCategoryRepository};
use App\Repositories\Wordpress\WpPostRepository;

class WpPostImportAction
{
    public function __construct(
        protected WpPostRepository $wpPostRepository,
        protected PostRepository $postRepository,
        protected PostCategoryRepository $postCategoryRepository
    ) { }

    public function execute(): void
    {
        $wpPosts = $this->wpPostRepository->getAll();

        foreach ($wpPosts as $wpPost) {
            $wpPostId = (int) $wpPost->ID;
            $categoryTaxonomy = $wpPost->taxonomies()->first();

            $params = [
                'wp_category_id' => $categoryTaxonomy->term->term_id ?? 0,
                'name'           => $wpPost->post_title,
                'created_at'     => $wpPost->post_date,
                'updated_at'     => $wpPost->post_modified
            ];

            $post = $this->postRepository->getByWordpressPostId($wpPostId);

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
    }
}

