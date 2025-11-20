<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProfileView;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $user = User::with('socialLinks', 'followers', 'following', 'posts.comments')->findOrFail($id);
        return view('my_profile', compact('user'));
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


    public function uploadCover(Request $request)
    {
        $user = auth('sanctum')->user(); // or auth('sanctum')->user() if using API token
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.']);
        }
    
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('cover'), $filename);
    
            $user->cover_photo = 'cover/' . $filename;
            $user->save();
    
            return response()->json([
                'success' => true,
                'path' => asset('cover/' . $filename)
            ]);
        }
    
        return response()->json(['success' => false, 'message' => 'No file uploaded.']);
    }
    
    public function updatePic(Request $request){
        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }
        if(request()->hasFile('profile_pic')){
            $file = request()->file('profile_pic');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $user->profile_pic = 'images/' . $filename;
            $user->save();
            return redirect()->back()->with('success', 'Profile Picture updated successfully.');
        }
        return redirect()->back()->with('error', 'No file uploaded.');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_detail = User::findOrFail($id);
        return view('pages/edit_profile', compact('user_detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                ]);
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function updatePassword(Request $request)
    {
        $user = $user = Auth::user();
        
        if(!$user){
            return redirect()->back()->with('error', 'User not authenticated.');
        }
        try{
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:8|confirmed',
              ]);
        } catch (ValidationException $e) {
            // Return with errors, specifying the 'passwordUpdate' error bag
            return redirect()->back()->withErrors($e->errors(), 'passwordUpdate')->withInput();
        }

         // 2. Custom current password check
        // Check if the current password matches the one in the database
        if (!Hash::check($request->input('current_password'), $user->password)) {
            // Manually return error to the 'passwordUpdate' bag
            return redirect()->back()->withErrors(['current_password' => 'The current password you provided does not match our records.'], 'passwordUpdate')->withInput();
        }
        // 3. Update password
        $user->password = Hash::make($request->input('password')); // Use Hash::make (modern Laravel) or bcrypt
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
