<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function unreadCount()
    {
        $user = auth()->user();
        return response()->json([
            'unread' => $user->unreadNotifications()->count()
        ]);
    }
}
