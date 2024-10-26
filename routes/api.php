<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [AuthenticationController::class, 'register']);
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('logout', [AuthenticationController::class, 'logout'])->middleware('auth:api');
    Route::get('user', [AuthenticationController::class, 'getUser'])->middleware('auth:api');
    Route::get('posts', [PostController::class, 'getPosts'])->middleware('auth:api');
    Route::post('store/post', [PostController::class, 'storePost'])->middleware('auth:api');
});
