<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    $articles = Article::with(['category', 'author.user'])->latest()->paginate(9);
    return view('welcome', compact('articles'));
})->name('welcome');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $articles = Article::with(['author', 'category'])->latest()->simplePaginate(9);
        return view('dashboard', compact('articles'));
    })->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::resource('categories', CategoryController::class);
        Route::resource('articles', ArticleController::class);
        Route::resource('users', UserController::class);
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });

    Route::middleware('role:writer')->group(function () {
        Route::get('/author', [AuthorController::class, 'index'])->name('author.index');
        Route::resource('articles', ArticleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    });

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

require __DIR__ . '/auth.php';
