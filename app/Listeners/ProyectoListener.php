<?php

namespace App\Listeners;

use App\Models\Users\User;
use App\Notifications\ProyectoNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProyectoListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        User::all()->each(function(User $user) use($event){
            if($user->hasRole('admin')){
                Notification::send($user, new ProyectoNotification($event->proyecto, $event->type, $event->old_proyecto));
            }
        });
    }
}
