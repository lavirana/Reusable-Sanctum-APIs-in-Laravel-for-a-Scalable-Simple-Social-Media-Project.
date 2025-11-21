<?php

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewFollower implements ShouldBroadcast
{
    public $follower;

    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->follower['followed_user_id']);
    }
}
