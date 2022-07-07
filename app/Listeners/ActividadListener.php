<?php

namespace App\Listeners;
use App\Models\Users\User;
use App\Notifications\ActividaNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActividadListener
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
        User::where('id', $event->type['user_id'])->get()->each(function(User $user) use($event){
            Notification::send($user, new ActividaNotification($event->actividad, $event->type, $event->old_actividad));
        });
    }
}
