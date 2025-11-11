<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Like; // Import the Like Model
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id(); // get logged-in user ID from sanctum token
        
        // FIX: Use withCount('likes') to calculate the number of likes for each post
        // The resulting JSON will now include 'likes_count' property.
        return Post::with('user')
            ->withCount('likes') // <-- CRITICAL ADDITION
            // IMPORTANT: If you want to show posts from all users (like a feed), 
            // you should remove or change the next line:
            // ->where('user_id', $userId) 
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $post = $request->user()->posts()->create($data);
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ]);
        $post->update($data);
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }

    /**
     * Toggles a like for a given post by the authenticated user.
     * @param Post $post The post being liked/unliked.
     */
    public function toggleLike(Post $post)
    {
        $userId = auth()->id();

        // 1. Find if a like already exists from this user for this post
        $like = $post->likes()->where('user_id', $userId)->first();
        $status = '';

        if ($like) {
            // 2. If the like exists, delete (unlike) it
            $like->delete();
            $status = 'unliked';
        } else {
            // 3. If no like exists, create a new one
            // We use the relationship defined in the Post Model (likes())
            $post->likes()->create(['user_id' => $userId]);
            $status = 'liked';
        }

        // Return the status back to the JavaScript
        return response()->json(['status' => $status]);
    }
}