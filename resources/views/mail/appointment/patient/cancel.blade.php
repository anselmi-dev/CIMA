<x-mail::message>

Hola {{ $appointment->patient->name }},

Tu cita médica ha sido cancelada.

- Fecha: {{ $appointment->start_at->format('d/m/Y') }}
- Hora: {{ $appointment->start_at->format('H:i') }}
- Doctor: {{ $appointment->professional->name }}
- Especialidad: {{ $appointment->medicalSpecialty->name }}

¡Gracias por confiar en nosotros!<br>
{{ config('app.name') }}
</x-mail::message>
