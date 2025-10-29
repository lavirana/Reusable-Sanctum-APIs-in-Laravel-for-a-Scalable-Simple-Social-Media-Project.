<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
            $keyword = $request->input('q');

            if(empty($keyword)){
                return response()->json(['message' => 'Keyword is required'], 400);
            }

            // search in post and user
             $posts = Post::where('title', 'like', "%keyword%")
                        ->orWhere('body', 'like', "%$keyword%")
                        ->take(5)
                        ->get(['id', 'title', 'body']);
             $users = User::where('name', 'like', "%$keyword%")
                        ->orWhere('email', 'like', "%$keyword%")
                        ->take(5)
                        ->get(['id', 'name', 'email', 'cover_photo']);
                        
            return response()->json([
                'posts' => $posts,
                'users' => $users
            ]);
    }
}
