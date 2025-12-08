<x-mail::message>
Hola {{ $appointment->professional->user->name }},

Se ha agendado una cita médica para el día:

- Fecha: {{ $appointment->start_at->format('d/m/Y') }}
- Hora: {{ $appointment->start_at->format('H:i') }}
- Doctor: {{ $appointment->professional->name }}
- Especialidad: {{ $appointment->medicalSpecialty->name }}

{{ config('app.name') }}
</x-mail::message>
