@component('mail::message')
# Nueva Cita Creada

Hola {{ $appointment->professional->user->name }},

Te informamos que se ha agendado una nueva cita para ti.

**Fecha y Hora:** {{ $appointment->start_at->format('d/m/Y H:i') }}

**Profesional:** {{ $appointment->professional->user->name }}

Gracias,

{{ config('app.name') }}

@endcomponent