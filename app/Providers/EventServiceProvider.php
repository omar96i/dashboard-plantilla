<?php

namespace App\Providers;

use App\Events\ActividadEvent;
use App\Events\CotizacionEvent;
use App\Events\ProyectoEvent;
use App\Events\UserEvent;
use App\Listeners\ActividadListener;
use App\Listeners\CotizacionListener;
use App\Listeners\ProyectoListener;
use App\Listeners\UserListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserEvent::class => [
            UserListener::class,
        ],
        CotizacionEvent::class => [
            CotizacionListener::class,
        ],
        ActividadEvent::class => [
            ActividadListener::class,
        ],
        ProyectoEvent::class => [
            ProyectoListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
