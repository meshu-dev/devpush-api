<?php

namespace App\Repositories\Wordpress;

use App\Models\Wordpress\Taxonomy;

class WpTaxonomyRepository
{
    public function getCategories()
    {
        $taxomyCategories = Taxonomy::where('taxonomy', 'category')->get();
        $terms = [];

        foreach ($taxomyCategories as $taxomyCategory) {
            $terms[] = $taxomyCategory->term;
        }
        return $terms;
    }
}