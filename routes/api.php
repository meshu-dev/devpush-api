<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    PostCategoryController,
    PostController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'posts'], function ($router) {
    Route::group(['prefix' => 'categories'], function ($router) {
        Route::get('/', [PostCategoryController::class, 'getAll']);
    });
    Route::get('/', [PostController::class, 'getAll']);
    Route::get('/urls', [PostController::class, 'getUrls']);
    Route::get('/{id}', [PostController::class, 'get']);
    Route::get('/slug/{slug}', [PostController::class, 'getBySlug']);
});
