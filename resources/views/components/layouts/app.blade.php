<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/icons/favicon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/icons/favicon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/icons/favicon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/icons/favicon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/icons/favicon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/icons/favicon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/icons/favicon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/icons/favicon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/icons/favicon-180x180.png')}}">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicons/icons/favicon.svg')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/icons/favicon-16x16.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/icons/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/icons/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/icons/favicon-192x192.png')}}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicons/icons/favicon.ico')}}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicons/icons/favicon.ico')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicons/icons/favicon-144x144.png')}}">
        <meta name="msapplication-config" content="{{ asset('favicons/icons/browserconfig.xml')}}">

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        @filamentStyles

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="bg-[#F9FAF5] h-full">

        <div class="flex flex-col w-full min-h-full">

            <!-- Page Heading -->
            @if (isset($header))
                {!! $header !!}
            @else
                <x-layouts.parts.header/>
            @endif
            <!-- Header -->
            
            <main class="flex-1 w-full">
                {{ $slot }}
            </main>
            
            <!-- Footer -->
            @if (isset($footer))
                {!! $footer !!}
            @else
                <x-layouts.parts.footer/>
            @endif
        </div>

        @stack('modals')

        @livewireScripts
        
        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
