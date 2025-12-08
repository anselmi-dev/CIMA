<?php

namespace App\Providers;

use App\Events\AppointmentCreated;
use App\Events\AppointmentUpdated;
use Illuminate\Support\Facades\Event;
// use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            \App\Listeners\SendAppointmentCreatedNotification::class,
            \App\Events\AppointmentCreated::class,
        );

        Event::listen(
            \App\Listeners\SendAppointmentUpdatedNotification::class,
            \App\Events\AppointmentUpdated::class,
        );

    }
}
