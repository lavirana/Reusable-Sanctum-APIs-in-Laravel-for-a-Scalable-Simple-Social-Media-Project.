<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{firstUserId}.{secondUserId}', function ($user, $firstUserId, $secondUserId) {
    // Convert to integers for comparison
    $id1 = (int) $firstUserId;
    $id2 = (int) $secondUserId;

    // Check if the authenticated user is one of the two participants
    return $user->id === $id1 || $user->id === $id2;
});