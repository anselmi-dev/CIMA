@props(['simple' => false])

<!-- Header -->
<header
    id="app-header"
    x-data="{
        open: false
    }"
    class="max-w-7xl mx-auto absolute inset-x-0 top-0 z-50">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="{{ route('home') }}" wire:navigate class="-m-1.5 p-1.5 text-white flex items-center flex-col">
                <img class="h-12 w-auto" src="{{ asset('logo/cima-color.svg') }}" alt="{{ config('app.name', 'Laravel') }}">
                <span class="text-base leading-none sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>
        </div>
        @if (!$simple)
            <div class="flex lg:hidden">
                <button type="button"
                    @click="open = !open"
                    @class([
                        "-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700",
                        "text-white" => request()->routeIs('home') || request()->routeIs('schedule.index')
                    ])
                    >
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div @class([
                "hidden lg:flex lg:gap-x-12 items-center",
                "text-white" => request()->routeIs('home') || request()->routeIs('schedule.index')
            ])>
                <a href="{{ route('about') }}" wire:navigate class="text-base tx:text-lg font-semibold leading-6">
                    {{ __('Quienes somos') }}
                </a>

                <a href="{{ route('contact') }}" wire:navigate class="text-base tx:text-lg font-semibold leading-6">
                    {{ __('Contactanos') }}
                </a>


                <a href="{{ route('schedule.index') }}" wire:navigate class="text-base tx:text-lg font-semibold leading-6 bg-A1-600 text-white px-4 py-2 rounded-md inline-flex items-center">
                    {{ __('Agenda tu hora') }}
                    <svg class="size-4 ml-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        @endif
    </nav>

    <div x-show="open" class="lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-50 backdrop-blur-sm bg-white/30" x-show="open" @click="open = false"></div>
        <div
            x-show="open"
            x-transition:enter="transition ease-in-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-[#F9FAF5] px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" wire:navigate class="-m-1.5 p-1.5">
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    <img class="h-12 w-auto" src="{{ asset('logo/cima-color.svg') }}"
                        alt="{{ config('app.name', 'Laravel') }}">
                </a>
                <button type="button" @click="open = false"
                    @class([
                        "-m-2.5 rounded-md p-2.5",
                    ])>
                    <span class="sr-only">Close menu</span>
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a href="{{ route('schedule.index') }}" wire:navigate class="-mx-3 block rounded-lg px-3 py-2 text-xl font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                            {{ __('Agenda tu hora') }}
                        </a>

                        <a href="{{ route('about') }}" wire:navigate class="-mx-3 block rounded-lg px-3 py-2 text-xl font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                            {{ __('Quienes somos') }}
                        </a>

                        <a href="{{ route('contact') }}" wire:navigate class="-mx-3 block rounded-lg px-3 py-2 text-xl font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                            {{ __('Contact') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
