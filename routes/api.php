<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\SubscribeController;
use App\Http\Controllers\Api\V1\Auth\UserLoginController;
use App\Http\Controllers\Api\V1\Auth\UserLogoutController;
use App\Http\Controllers\Api\V1\Auth\UserRegisterController;

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
    // auth
    Route::post('/auth/register', UserRegisterController::class);
    Route::post('/auth/login', UserLoginController::class);
    Route::post('/auth/logout', UserLogoutController::class)->middleware("auth:sanctum");

    Route::group(['middleware'=>'auth:sanctum'], function () {
        Route::get('/user', fn (Request $request) => $request->user());

        Route::apiResource('posts', PostController::class);

        // subscribers from user
        Route::get('/users/{user}/subscriber-list', [SubscribeController::class, 'subscribers']);
        // subscribers to user
        Route::get('/users/{user}/subscribing-list', [SubscribeController::class, 'subscribing']);
        Route::post('/users/{user}/subscribe', [SubscribeController::class, 'subscribe']);
        Route::post('/users/{user}/unsubscribe', [SubscribeController::class, 'unsubscribe']);
        // user list
        Route::get('/users', [UserController::class, 'userList']);
    });
});
