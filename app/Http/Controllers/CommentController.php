<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['article', 'user'])->paginate(10);
        return response()->json($comments);
    }

    public function show(Comment $comment)
    {
        $comment->load(['article', 'user']);
        return response()->json($comment);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'article_id' => 'required|exists:articles,id',
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'article_id' => $request->article_id,
            'user_id' => Auth::id(),
        ]);

        return $request->expectsJson()
            ? response()->json($comment, 201)
            : redirect()->route('articles.show', $comment->article_id)->with('success', 'Komentar ditambahkan.');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorizeComment($comment);
        $request->validate(['content' => 'required|string']);
        $comment->update($request->all());
        return response()->json($comment);
    }

    public function destroy(Comment $comment)
    {
        $this->authorizeComment($comment);
        $comment->delete();
        return request()->expectsJson()
            ? response()->json(['message' => 'Komentar dihapus'])
            : redirect()->back()->with('success', 'Komentar dihapus.');
    }

    protected function authorizeComment(Comment $comment)
    {
        if (Auth::user()->role->name === 'reader' && $comment->user_id !== Auth::id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
    }
}
