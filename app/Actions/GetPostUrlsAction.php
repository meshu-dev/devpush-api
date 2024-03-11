<?php

namespace App\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostUrlResource;
use App\Repositories\PostRepository;

class GetPostUrlsAction
{
    public function __construct(
        protected PostRepository $postRepository
    ) { }

    public function execute(): JsonResource
    {
        $urls = $this->postRepository->getAllUrls();

        $urls = $urls->filter(function ($post) {
            return $post->wpPost->slug;
        });

        return PostUrlResource::collection($urls);
    }
}
