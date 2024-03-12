<?php

namespace App\Actions\Post;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;

class GetPostBySlugAction
{
    public function __construct(
        protected PostRepository $postRepository
    ) { }

    public function execute(string $slug): JsonResource
    {
        return new PostResource($this->postRepository->getBySlug($slug));
    }
}
