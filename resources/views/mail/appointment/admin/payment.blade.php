<x-mail::message>
Hola {{ $appointment->patient->name }},

Tu reserva para la cita médica ha sido confirmada.

- Fecha: {{ $appointment->start_at->format('d/m/Y') }}
- Hora: {{ $appointment->start_at->format('H:i') }}
- Doctor: {{ $appointment->professional->name }}
- Especialidad: {{ $appointment->medicalSpecialty->name }}

Debe comprobar el pago de la cita médica.

{{ config('app.name') }}
</x-mail::message>
