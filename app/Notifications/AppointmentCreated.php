<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;

class AppointmentCreated extends Notification
{
    use Queueable, ShouldQueue;

    /**
     * Create a new notification instance.
     */
    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Tu cita médica está pendiente de confirmación')
                    ->greeting('Hola ' . $notifiable->name)
                    ->line('Tu cita médica está pendiente de confirmación con los siguientes detalles:')
                    ->line('Fecha: ' . $this->appointment->start_at->format('d/m/Y'))
                    ->line('Hora: ' . $this->appointment->start_at->format('H:i'))
                    ->line('Doctor: ' . $this->appointment->professional->name)
                    ->line('Especialidad: ' . $this->appointment->medical_specialty->name)
                    ->action('Confirmar cita', route('schedule.confirm', [
                        'appointment' => $this->appointment->id
                    ]))
                    ->line('Atención: Su cita al no ser confirmada se cancelará automáticamente al pasar 3 horas desde que se agendó. Si desea cancelar la agenda puede hacerlo desde aquí o póngase en contacto con nosotros al <a href="mailto:'.env('MAIL_FROM_ADDRESS').'">'.env('MAIL_FROM_ADDRESS').'</a>.')
                    ->action('Cancelar cita', route('schedule.cancel', [
                        'appointment' => $this->appointment->id
                    ]))
                    ->line('¡Gracias por confiar en nosotros!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
