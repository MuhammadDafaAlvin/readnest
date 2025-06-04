<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::with(['category', 'author'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'author_id' => Auth::user()->author->id,
        ]);

        return $article;
    }

    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article->load(['category', 'author.user', 'comments.user']),
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $this->authorizeArticle($article);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article->update($request->all());
        return $article;
    }

    public function destroy(Article $article)
    {
        $this->authorizeArticle($article);
        $article->delete();
        return response()->json(['message' => 'Article deleted']);
    }

    protected function authorizeArticle(Article $article)
    {
        if (Auth::user()->role->name == 'writer' && $article->author_id != Auth::user()->author->id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
