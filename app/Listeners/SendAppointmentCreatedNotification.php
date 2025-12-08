<?php

namespace App\Listeners;

use App\Events\AppointmentCreated;
use App\Mail\AppointmentToPatientCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendAppointmentCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\AppointmentCreated  $event
     * @return void
     */
    public function handle(AppointmentCreated $event)
    {
        Mail::to($event->appointment->patient->email)->send(new AppointmentToPatientCreated($event->appointment));
    }
}