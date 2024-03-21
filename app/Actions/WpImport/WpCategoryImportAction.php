<?php

namespace App\Actions\WpImport;

use App\Repositories\Wordpress\WpTaxonomyRepository;
use App\Services\PostService;

class WpCategoryImportAction
{
    public function __construct(
        protected WpTaxonomyRepository $wpTaxonomyRepository,
        protected PostService $postService
    ) { }

    public function execute(): void
    {
        $wpCategories = $this->wpTaxonomyRepository->getCategories();

        foreach ($wpCategories as $wpCategory) {
            $this->postService->processPostCategory($wpCategory);
        }
    }
}
