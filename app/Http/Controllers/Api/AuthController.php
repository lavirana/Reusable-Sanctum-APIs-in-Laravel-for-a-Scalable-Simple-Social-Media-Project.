<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('api_token')->plainTextToken;

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

    public function mostViewed()
{
    $users = User::select('users.id', 'users.name', 'users.email', DB::raw('COUNT(profile_views.id) as total_views'))
        ->leftJoin('profile_views', 'users.id', '=', 'profile_views.viewed_user_id')
        ->groupBy('users.id', 'users.name', 'users.email')
        ->orderByDesc('total_views')
        ->limit(10)
        ->get();

    return response()->json($users);
}

}
