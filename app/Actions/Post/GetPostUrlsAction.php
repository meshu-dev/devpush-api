<?php

namespace App\Actions\Post;

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
        
        return PostUrlResource::collection($urls);
    }
}
