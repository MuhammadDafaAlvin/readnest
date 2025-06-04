<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('articles', ArticleController::class);
        Route::apiResource('comments', CommentController::class);
    });

    Route::middleware('role:writer')->group(function () {
        Route::apiResource('articles', ArticleController::class)->only(['store', 'update', 'destroy']);
    });

    Route::middleware('role:reader,writer,admin')->group(function () {
        Route::apiResource('articles', ArticleController::class)->only(['index', 'show']);
        Route::apiResource('comments', CommentController::class)->only(['store']);
    });
});
