<?php

namespace App\Http\Controllers;

use App\Actions\GetPostCategoriesAction;

class PostCategoryController extends Controller
{   
    public function getAll(GetPostCategoriesAction $getPostsAction)
    {
        return $getPostsAction->execute();
    }
}
