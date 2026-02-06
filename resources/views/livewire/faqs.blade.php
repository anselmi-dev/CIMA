<x-container.page :title="__('Preguntas frecuentes')">
    <div
        class="mx-auto max-w-2xl divide-y divide-gray-900/10 px-6 pb-8 sm:pb-24 sm:pt-12 lg:max-w-7xl lg:px-8 lg:pb-32">
        <dl class="mt-10 space-y-8 divide-y divide-gray-900/10">
            @forelse($faqs as $faq)
                <div class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
                    <dt class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5">
                        {{ $faq->ask }}
                    </dt>
                    <dd class="mt-4 lg:col-span-7 lg:mt-0">
                        <p class="text-base leading-7 text-gray-600">
                            {{ $faq->answer }}
                        </p>
                    </dd>
                </div>
            @empty
                <div class="pt-8 text-center text-gray-500">
                    {{ __('No hay preguntas frecuentes disponibles.') }}
                </div>
            @endforelse
        </dl>
    </div>
</x-container.page>
