<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::with(['article', 'user'])->get();
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

        return $comment;
    }

    public function show(Comment $comment)
    {
        return $comment->load(['article', 'user']);
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate(['content' => 'required|string']);
        $comment->update($request->all());
        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['message' => 'Comment deleted']);
    }
}
