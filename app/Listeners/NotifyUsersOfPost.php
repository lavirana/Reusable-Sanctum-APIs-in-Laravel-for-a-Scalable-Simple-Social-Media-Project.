<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUsersOfPost implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostPublished $event): void
    {
        $users =   User::all();
         foreach($users as $user) {
            Mail::raw("Hello ' {$user->name} ', A new article titled ' {$event->article->title} ' has been published", function($message) use ($user){
                $message->to($user->email)
                ->subject('New Article Published');
            });
    }
}
}
