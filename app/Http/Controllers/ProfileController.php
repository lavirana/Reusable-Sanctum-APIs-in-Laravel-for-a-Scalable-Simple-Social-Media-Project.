<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProfileView;
use App\Models\User;

class ProfileController extends Controller
{
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
    public function show($id)
    {
        $viewedUser = User::findOrFail($id);
        $viewerId = auth()->id();
    
        // Avoid self-view counting
        if ($viewerId && $viewerId != $id) {
            ProfileView::create([
                'viewer_id' => $viewerId,
                'viewed_user_id' => $id
            ]);
        }
    
        return response()->json($viewedUser);
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
