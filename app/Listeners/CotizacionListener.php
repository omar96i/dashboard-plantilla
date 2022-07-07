<?php

namespace App\Listeners;

use App\Models\Users\User;
use App\Notifications\CotizacionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;


class CotizacionListener
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
                Notification::send($user, new CotizacionNotification($event->cotizacion, $event->type, $event->old_cotizacion));
            }
        });
    }
}
