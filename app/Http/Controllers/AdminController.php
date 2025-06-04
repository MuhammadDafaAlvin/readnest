<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'articlesCount' => Article::count(),
            'categoriesCount' => Category::count(),
            'commentsCount' => Comment::count(),
            'usersCount' => User::count(),
        ]);
    }
}
