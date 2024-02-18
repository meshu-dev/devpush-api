<?php

namespace App\Http\Controllers;

use App\Actions\{GetPostListAction, GetPostAction};

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
}
