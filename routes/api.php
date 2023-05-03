<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Subscribe;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\UserLoginController;
use App\Http\Controllers\Api\V1\UserRegisterController;

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

Route::group(['prefix'=>'v1'], function () {
    // register and login
    Route::post('/auth/register', UserRegisterController::class);
    Route::post('/auth/login', UserLoginController::class);

    Route::group(['middleware'=>'auth:sanctum'], function () {
        Route::get('/user', fn (Request $request) => $request->user());

        Route::apiResource('posts', PostController::class);

        Route::get('/users/{user}/subscriber-list', [Subscribe::class, 'subscribers']);
        Route::get('/users/{user}/subscribe', [Subscribe::class, 'subscribe']);
        Route::get('/users/{user}/unsubscribe', [Subscribe::class, 'unsubscribe']);
    });
});
