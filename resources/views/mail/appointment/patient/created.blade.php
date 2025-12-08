<x-mail::message>
Hola {{ $appointment->patient->name }},

Tu reserva para la cita médica está pendiente de confirmación.

- Fecha: {{ $appointment->start_at->format('d/m/Y') }}
- Hora: {{ $appointment->start_at->format('H:i') }}
- Doctor: {{ $appointment->professional->name }}
- Especialidad: {{ $appointment->medicalSpecialty->name }}

<x-mail::button :url="route('schedule.confirm', ['appointment' => $appointment->uuid])" class="bg-A1-600 hover:bg-A1-700">
Confirmar cita
</x-mail::button>

<p style="background-color: #F9FAF5; padding: 10px;" class="text-center">
Su cita al no ser confirmada se cancelará automáticamente al pasar 3 horas desde que se agendó. Si desea cancelar la agenda puede hacerlo desde aquí o póngase en contacto con nosotros al <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a>.
</p>

¡Gracias por confiar en nosotros!<br>
{{ config('app.name') }}
</x-mail::message>
