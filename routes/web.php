<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    $articles = Article::with(['category', 'author.user'])->paginate(9);
    return view('welcome', compact('articles'));
})->name('welcome');

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $articles = Article::with(['author', 'category'])->get();
        return view('dashboard', compact('articles'));
    })->name('dashboard');

    Route::resource('articles', ArticleController::class)->except(['show'])->middleware('role:admin,writer');
    Route::resource('categories', CategoryController::class)->middleware('role:admin');
    Route::resource('comments', CommentController::class)->middleware('role:admin');
});

require __DIR__ . '/auth.php';
