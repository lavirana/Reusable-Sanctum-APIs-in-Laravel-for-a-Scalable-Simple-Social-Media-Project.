<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewLikeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $liker;
    public $post;

    public function __construct($liker, $post = null)
    {
        $this->liker = $liker;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        // database so it's saved, broadcast so it goes over websocket
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'like',
            'liker_id' => $this->liker->id,
            'liker_name' => $this->liker->name,
            'post_id' => $this->post?->id,
            'message' => $this->liker->name . ' liked your post.',
        ];
    }

    public function toBroadcast($notifiable)
    {
        // same payload for client consumption
        return new BroadcastMessage([
            'data' => $this->toDatabase($notifiable),
            'id' => (string) \Str::uuid(),
            'created_at' => now()->toDateTimeString(),
        ]);
    }
}
