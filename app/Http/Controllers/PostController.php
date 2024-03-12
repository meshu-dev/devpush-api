<?php

namespace App\Http\Controllers;

use App\Actions\Post\{GetPostListAction, GetPostAction, GetPostUrlsAction, GetPostBySlugAction};

class PostController extends Controller
{   
    public function getAll(GetPostListAction $getPostsAction)
    {
        return $getPostsAction->execute();
    }

    public function get(int $id, GetPostAction $getPostAction)
    {
        return $getPostAction->execute($id);
    }

    public function getUrls(GetPostUrlsAction $getPostUrlsAction)
    {
        return $getPostUrlsAction->execute();
    }

    public function getBySlug(string $slug, GetPostBySlugAction $getPostBySlugAction)
    {
        return $getPostBySlugAction->execute($slug);
    }
}
