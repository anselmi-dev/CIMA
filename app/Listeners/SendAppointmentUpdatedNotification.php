<?php

namespace App\Listeners;

use App\Events\AppointmentUpdated;
use App\Mail\AppointmentPaymentMail;
use App\Mail\AppointmentToPatientCancel;
use App\Mail\AppointmentScheduledMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendAppointmentUpdatedNotification implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\AppointmentCreated  $event
     * @return void
     */
    public function handle(AppointmentUpdated $event)
    {
        if ($event->appointment->status === 'payment') {
            // Envio de correo al adminstrador
            Mail::to(config('mail.admin_email'))->send(new AppointmentPaymentMail($event->appointment));
        }

        if ($event->appointment->status === 'scheduled') {
            // Envio de correo al profesional
            Mail::to($event->appointment->professional->user->email)->send(new AppointmentScheduledMail($event->appointment));
            // Envio de correo al paciente
            Mail::to($event->appointment->patient->email)->send(new AppointmentToPatientScheduledMail($event->appointment));
        }

        if ($event->appointment->status === 'cancelled') {
            Mail::to($event->appointment->patient->email)->send(new AppointmentToPatientCancel($event->appointment));
        }
    }
}