<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.article');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'status' => 'required|in:active,inactive',
            'views' => 'nullable|integer|min:0',
            'featured' => 'nullable|boolean',
        ]);
    
        $article = new Article();
        $article->title = $validatedData['title'];
        $article->body = $validatedData['body'];
        $article->status = $validatedData['status'];
        $article->views = $validatedData['views'] ?? 0;
        $article->featured = $request->boolean('featured');
        $article->user_id = auth()->id() ?? 1;
        $article->save();
    
        // notify admin
        Mail::raw("A new article titled ' {$article->title} ' has been published", function($message){
            $message->to('admin@admin.com')
            ->subject('New Article Published');
        });

        //notify all user

        
        return redirect()
            ->route('create-article')
            ->with('success', 'Article created successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
