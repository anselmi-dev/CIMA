@props(['title' => null, 'subtitle' => null, 'squareBg' => true])

<div class="relative isolate px-6 py-24 sm:py-32 lg:px-8">
    
    @if ($squareBg)
        <x-layouts.parts.square-bg/>
    @endif

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        @if ($title)
            <div class="mx-auto max-w-2xl lg:mx-0">
                @if ($subtitle)
                    <p class="text-base font-semibold leading-7 text-indigo-600">
                        {{ $subtitle }}
                    </p>
                @endif

                <h2 class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                    {{ $title }}
                </h2>
            </div>
        @endif

        {{ $slot }}
    </div>
</div>
