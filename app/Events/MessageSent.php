<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
// CRITICAL FIX: Import PrivateChannel for secure, authenticated broadcasting
use Illuminate\Broadcasting\PrivateChannel; 
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        // Load the sender relationship so the receiver knows who sent the message
        $this->message = $message->load('sender');
    }

    /**
     * The channel(s) the event should broadcast on.
     * This uses the sorted, bidirectional PrivateChannel logic to match routes/channels.php.
     */
    public function broadcastOn(): PrivateChannel
    {
        // Get both user IDs
        $ids = [$this->message->sender_id, $this->message->receiver_id];
        // Sort them to ensure the channel name is always the same regardless of who sends the message (e.g., chat.5.10, not chat.10.5)
        sort($ids); 
        
        // Channel name: 'chat.{lowerId}.{higherId}'
        $channelName = 'chat.' . implode('.', $ids); 

        // Use PrivateChannel for security and to trigger the authorization check
        return new PrivateChannel($channelName);
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
}