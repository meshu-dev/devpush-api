<?php

namespace App\Actions\Post;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostCategoryResource;
use App\Repositories\PostCategoryRepository;

class GetPostCategoriesAction
{
    public function __construct(
        protected PostCategoryRepository $postCategoryRepository
    ) { }

    public function execute(): JsonResource
    {
        return PostCategoryResource::collection($this->postCategoryRepository->getAll());
    }
}
