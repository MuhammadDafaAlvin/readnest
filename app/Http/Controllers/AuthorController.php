<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function index()
    {
        $articles = Article::where('author_id', Auth::user()->author->id)
            ->with(['category', 'author.user'])
            ->latest()
            ->paginate(9);
        return view('author.index', compact('articles'));
    }
}
