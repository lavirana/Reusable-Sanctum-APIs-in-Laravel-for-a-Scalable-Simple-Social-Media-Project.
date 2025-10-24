<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;

class MessageController extends Controller
{
    // fetch conversation between two users
    public function getMessages($receiver_id)
    {
        $user = auth()->user();

        $messages = Message::where(function($q) use ($user, $receiver_id) {
                $q->where('sender_id', $user->id)
                  ->where('receiver_id', $receiver_id);
            })
            ->orWhere(function($q) use ($user, $receiver_id) {
                $q->where('sender_id', $receiver_id)
                  ->where('receiver_id', $user->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    // send message
    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $data['receiver_id'],
            'message' => $data['message']
        ]);
  // broadcast this message in real time
  event(new MessageSent($message));

        return response()->json(['status' => true, 'message' => $message]);
    }

    // Get all messages between logged-in user and receiver
public function fetchMessages($receiver_id)
{
    $userId = auth()->id();

    $messages = Message::where(function ($q) use ($userId, $receiver_id) {
        $q->where('sender_id', $userId)->where('receiver_id', $receiver_id);
    })->orWhere(function ($q) use ($userId, $receiver_id) {
        $q->where('sender_id', $receiver_id)->where('receiver_id', $userId);
    })->orderBy('created_at', 'asc')->get();

    return response()->json(['messages' => $messages]);
}

}
