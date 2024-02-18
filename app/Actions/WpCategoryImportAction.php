<?php

namespace App\Actions;

use App\Repositories\PostCategoryRepository;
use App\Repositories\Wordpress\WpTaxonomyRepository;

class WpCategoryImportAction
{
    public function __construct(
        protected WpTaxonomyRepository $wpTaxonomyRepository,
        protected PostCategoryRepository $postCategoryRepository
    ) { }

    public function execute(): void
    {
        $wpCategories = $this->wpTaxonomyRepository->getCategories();

        foreach ($wpCategories as $wpCategory) {
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
}
