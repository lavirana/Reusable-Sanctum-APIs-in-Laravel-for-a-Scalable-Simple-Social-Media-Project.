<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function toggle(Request $request, $postId){

        $like = Like::where('user_id', $request->user()->id)
                 ->where('post_id', $postId)
                ->first();

                if ($like) {
                    $like->delete();
                    $status = 'unliked';
                } else {
                    Like::create([
                        'user_id' => $request->user()->id,
                        'post_id' => $postId,
                    ]);
                    $status = 'liked';
                }
                return response()->json(['status' => $status]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
