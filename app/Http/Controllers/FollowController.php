<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{

    public function toggle(Request $request, $userId){
        //login user can follow or unfollow another user
        //if already the entry exist in the follows table, then check the status and toggle it
        //else create a new entry with follow status

        $login_user_id = $request->auth()->user()->id;
        //$login_user_id = 1;
        $follow_to_user_id = $userId;

        // Prevent users from following themselves
        if ($login_user_id == $follow_to_user_id) {
            return response()->json(['error' => 'You cannot follow yourself.'], 400);
        }
        $follow = \App\Models\Follow::where('follower_id', $login_user_id)
                    ->where('followed_id', $follow_to_user_id)
                    ->first();

        if ($follow) {
            // Toggle follow status
            $follow->follow_status = $follow->follow_status === 'follow' ? 'unfollow' : 'follow';
            $follow->save();
            $status = $follow->follow_status;
        } else {
            // Create new follow entry
            \App\Models\Follow::create([
                'follower_id' => $login_user_id,
                'followed_id' => $follow_to_user_id,
                'follow_status' => true,
            ]);
            $status = 'followed';
        }
        return response()->json(['status' => $status]);
         
    }
  
}
