<?php

namespace App\Actions\WpImport;

use App\Exceptions\WpPostSlugBlankException;
use App\Repositories\Wordpress\WpPostRepository;
use App\Services\PostService;

class WpPostImportAction
{
    public function __construct(
        protected WpPostRepository $wpPostRepository,
        protected PostService $postService
    ) { }

    public function execute(): void
    {
        $wpPosts = $this->wpPostRepository->getAll();

        foreach ($wpPosts as $wpPost) {
            throw_if(
                !$wpPost->slug,
                WpPostSlugBlankException::class,
                'Wordpress post with ID ' . $wpPost->ID . ' has a blank slug'
            );

            $this->postService->upsertPost($wpPost);
        }
    }
}


