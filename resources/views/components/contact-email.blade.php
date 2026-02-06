@php
    $email = settings('email');
@endphp

@if($email)
    <a href="mailto:{{ $email }}" {{ $attributes->merge(['class' => 'font-semibold text-white hover:underline']) }}>{{ $email }}</a>
@else
    <span {{ $attributes->merge(['class' => 'font-semibold text-white opacity-80']) }}>{{ $slot->isNotEmpty() ? $slot : __('correo de contacto') }}</span>
@endif
