<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Auth::user()->role->name === 'writer'
            ? Article::where('author_id', Auth::user()->author->id)->with(['category', 'author.user'])->paginate(9)
            : Article::with(['category', 'author.user'])->paginate(9);

        return request()->expectsJson()
            ? response()->json($articles)
            : view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'author_id' => Auth::user()->author->id,
            'image' => $imagePath,
        ]);

        return request()->expectsJson()
            ? response()->json($article, 201)
            : redirect()->route('articles.show', $article)->with('success', 'Artikel dibuat.');
    }

    public function show(Article $article)
    {
        $article->load(['category', 'author.user', 'comments.user']);
        return request()->expectsJson()
            ? response()->json($article)
            : view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorizeArticle($article);
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorizeArticle($article);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : $article->image;

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return request()->expectsJson()
            ? response()->json($article)
            : redirect()->route('articles.show', $article)->with('success', 'Artikel diperbarui.');
    }

    public function destroy(Article $article)
    {
        $this->authorizeArticle($article);
        $article->delete();
        return request()->expectsJson()
            ? response()->json(['message' => 'Artikel dihapus'])
            : redirect()->route('articles.index')->with('success', 'Artikel dihapus.');
    }

    protected function authorizeArticle(Article $article)
    {
        if (Auth::user()->role->name === 'writer' && $article->author_id !== Auth::user()->author->id) {
            abort(403, 'Aksi tidak diizinkan.');
        }
    }
}
