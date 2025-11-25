<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user.{id}', function ($user, $id) {
    // only allow the real user to listen to their channel
    return (int) $user->id === (int) $id;
});

