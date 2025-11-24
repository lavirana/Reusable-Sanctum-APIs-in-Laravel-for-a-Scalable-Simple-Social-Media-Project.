<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewLikeNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $liker;
    public $post;

    public function __construct($liker, $post)
    {
        $this->liker = $liker;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->liker->name . ' liked your post',
            'post_id' => $this->post->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->liker->name . ' liked your post',
            'post_id' => $this->post->id,
        ]);
    }

    public function broadcastOn()
    {
        return ['user.' . $this->post->user_id];
    }

    public function broadcastAs()
    {
        return 'NewFollower'; // your JS listens for NewFollower
    }
}
