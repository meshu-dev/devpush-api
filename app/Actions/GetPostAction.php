<?php

namespace App\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;

class GetPostAction
{
    public function __construct(
        protected PostRepository $postRepository
    ) { }

    public function execute(int $id): JsonResource
    {
        return new PostResource($this->postRepository->get($id));
    }
}
