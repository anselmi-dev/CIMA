<x-mail::message>
{{ __('Has recibido un nuevo mensaje de contacto desde la web.') }}

**{{ __('Nombre') }}:** {{ $name }} {{ $last_name }}

**{{ __('Email') }}:** {{ $email }}

**{{ __('Mensaje') }}:**

{{ $message }}

---

{{ __('Puedes responder directamente a este correo.') }}<br>
{{ config('app.name') }}
</x-mail::message>
