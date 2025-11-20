<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    
    public function register(Request $request){
         $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
         ]);

         $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
         ]);

         $token = $user->createToken('api_token')->plainTextToken;

         return response()->json([
            'user' => $user,
            'token' => $token,
         ],201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        // 1️⃣ Attempt web guard login
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    
        $user = auth()->user();
    
        // 2️⃣ Regenerate session for security (important)
        $request->session()->regenerate();
    
        // 3️⃣ Create sanctum token (used by API calls)
        $token = $user->createToken('web_token')->plainTextToken;
    
        // If request is from Blade form → redirect
        if (!$request->expectsJson()) {
            return redirect()->intended('/dashboard'); // or your homepage
        }
    
        // If API request → return JSON
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
    

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        $user->followers_count = $user->followers()->count();
        $user->following_count = $user->following()->count();

        return response()->json($user);
    }

    public function update(Request $request){
       $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $request->user()->id,
            'password' => 'sometimes|confirmed|min:6',
       ]);

       if(!empty($validated['password'])){
        $validated['password'] = bcrypt($validated['password']);
       }

       $request->user()->update($validated);
       
       return response()->json([
        'status' => true,
        'message' => 'Profile updated successfully',
        'data' => $request->user()
    ]);
    }
    public function viewProfile($userId)
{
    $viewerId = auth('sanctum')->id();

    // Prevent self-view count
    if ($viewerId == $userId) {
        return response()->json(['message' => 'Self view ignored']);
    }

    DB::table('profile_views')->insert([
        'viewed_user_id' => $userId,
        'viewer_id' => $viewerId,
        'created_at' => now(),
    ]);

    return response()->json(['message' => 'View counted']);
}


public function mostViewed()
{
    $authUserId = auth('sanctum')->id();

    $users = User::select(
            'users.id',
            'users.name',
            'users.email',
            DB::raw('COUNT(profile_views.id) as total_views')
        )
        ->leftJoin('profile_views', 'users.id', '=', 'profile_views.viewed_user_id')
        ->where('users.id', '!=', $authUserId) // remove logged-in user
        ->groupBy('users.id', 'users.name', 'users.email')
        ->havingRaw('total_views > 0') // show only users with views
        ->orderByDesc('total_views')
        ->limit(10)
        ->get();

    return response()->json($users);
}


public function get_user_profile(Request $request, $id)
{
    // Find the user by ID from the URL
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'User not found'
        ], 404);
    }

    // Optional: logged-in user for checking if they follow this user
    $authUser = $request->user();
    $isFollowing = false;

    if ($authUser) {
        $isFollowing = Follow::where('follower_id', $authUser->id)
            ->where('followed_id', $user->id)
            ->where('follow_status', 'followed')
            ->exists();
    }

    // Followers and following counts for this user
    $followersCount = Follow::where('followed_id', $user->id)
        ->where('follow_status', 'followed')
        ->count();

    $followingCount = Follow::where('follower_id', $user->id)
        ->where('follow_status', 'followed')
        ->count();

    return response()->json([
        'status' => true,
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'cover_photo' => $user->cover_photo,
            'followers_count' => $followersCount,
            'following_count' => $followingCount,
            'is_following' => $isFollowing,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]
    ]);
}



public function allUsersExceptMe(Request $request)
{
    $user = $request->user(); // logged-in user via Sanctum

    
    $user->followers_count = $user->followers()->count();
    $user->following_count = $user->following()->count();

    $users = User::where('id', '!=', $user->id)
        ->select('id', 'name', 'email')
        ->latest()
        ->get()
        ->map(function ($u) use ($user) {
            // Check if logged-in user already follows this user
            $isFollowing = Follow::where('follower_id', $user->id)
                ->where('followed_id', $u->id)
                ->where('follow_status', 'followed')
                ->exists();

            $u->is_following = $isFollowing;
            return $u;
        });

    return response()->json([
        'status' => true,
        'total' => $users->count(),
        'users' => $users
    ]);
}


}

