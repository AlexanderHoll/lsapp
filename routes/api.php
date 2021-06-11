<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Functions declared in API controller are routed to here
Route::get('posts', [ApiController::class, 'getAllPosts']);
Route::get('posts/{id}', [ApiController::class, 'getPost']);
Route::post('posts', [ApiController::class, 'createPost']);
Route::put('posts/{id}', [ApiController::class, 'updatePost']);
Route::delete('posts/{id}', [ApiController::class, 'deletePost']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
