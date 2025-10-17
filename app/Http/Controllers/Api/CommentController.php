<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($postId){
        $comments = Comment::with('user:id,name')->where('post_id', $postId)->latest()->get();
        return response()->json($comments);
    }

    public function store(Request $request, $postId){
        $data = $request->validate([
            'body' => 'required|string',
        ]);

        $comment = $request->user()->comments()->create([
            'body' => $data['body'],
            'post_id' => $postId,
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'data' => $data
        ],201);
    }

    public function destroy($id){
        $comment = Comment::where('user_id', auth()->id())->findOrFail($id);
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
