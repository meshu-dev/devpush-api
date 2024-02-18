<?php

namespace App\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostListResource;
use App\Repositories\PostRepository;

class GetPostListAction
{
    public function __construct(
        protected PostRepository $postRepository
    ) { }

    public function execute(): JsonResource
    {
        return PostListResource::collection($this->postRepository->getPaginated());
    }
}
