<div>
    <div
        class="h-min-screen h-screen w-full max-w-full relative isolate overflow-hidden bg-gray-900 pt-14 pb-16 sm:pb-20">

        <x-layouts.parts.blend-multiply class="opacity-30" />

        <div class="absolute inset-0 -z-10 size-full object-cover">
            <video class="wp-block-cover__video-background intrinsic-ignore size-full object-cover" autoplay=""
                muted="" loop="" playsinline=""
                src="https://cer.cl/wp-content/uploads/2025/02/cer-cl-video-home.mp4" data-object-fit="cover"></video>
        </div>

        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
            aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-1155/678 w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>


        <div class="mx-auto max-w-7xl px-6 lg:px-8 z-1 relative h-full flex items-center justify-center">
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">
                        <x-layouts.parts.crossed-out>Tu salud</x-layouts.parts.crossed-out> en las mejores manos
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-white sm:max-w-md lg:max-w-none">
                        {{ __('En CIMA, conectamos pacientes con especialistas médicos de primer nivel en Chile. Reserva tu cita fácilmente y accede a la atención que necesitas para cuidar de tu bienestar. Salud a tu alcance, con solo un clic.') }}
                    </p>
                    <div class="mt-10 flex items-center gap-x-6 text-center mx-auto justify-center">
                        <a href="{{ route('schedule.index') }}"
                            wire:navigate
                            class="rounded-md bg-A1-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-A1-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-A1-600">
                            {{ __('Agendar cita') }}
                        </a>
                        <a href="{{ route('contact') }}" wire:navigate class="text-sm font-semibold leading-6 text-white">
                            {{ __('Contáctanos') }}
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto flex flex-col space-y-32 px-6 lg:px-8">
        <div class="py-24 sm:py-32">
            <div class="mx-auto max-w-7xl">
                <div data-aos="fade-up" class="mx-auto max-w-5xl lg:mx-0">
                    <h2 class="text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                        Bienvenidos a <span class="text-A1-600">CIMA</span>
                    </h2>
                    <p class="mt-4 text-xl font-semibold text-gray-700">
                        Centro Integral Multidisciplinario de Aprendizaje
                    </p>
                    <p class="mt-6 text-xl text-gray-600">
                        En CIMA creemos que cada persona merece ser acompañada con respeto, empatía y dedicación en su proceso de crecimiento y bienestar. Somos un centro clínico integral conformado por profesionales de <span class="font-semibold text-gray-900">psicopedagogía</span>, <span class="font-semibold text-gray-900">psicología</span>, <span class="font-semibold text-gray-900">fonoaudiología</span> y <span class="font-semibold text-gray-900">acompañamiento especializado (babysitter)</span>, que trabajamos de manera colaborativa para entregar una atención completa en cada etapa del ciclo vital.
                    </p>
                    <p class="mt-4 text-xl text-gray-600">
                        Nuestro compromiso es ofrecer un espacio seguro, acogedor y profesional, donde cada persona pueda descubrir sus potencialidades y recibir el apoyo necesario para desarrollarse plenamente. En CIMA, el aprendizaje y el crecimiento se producen en un ambiente de <span class="italic text-A1-600">amor, respeto e inclusión</span>.
                    </p>
                </div>
                <div
                    class="mx-auto mt-16 flex max-w-2xl flex-col gap-8 lg:mx-0 lg:mt-20 lg:max-w-none lg:flex-row lg:items-end">
                    <div data-aos="fade-up"
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-A1-500 p-8 sm:w-3/4 sm:max-w-md sm:flex-row-reverse sm:items-end lg:w-72 lg:max-w-none lg:flex-none lg:flex-col lg:items-start">
                        <p class="flex-none text-3xl font-bold tracking-tight text-gray-900"></p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white uppercase">
                                Psicopedagogía
                            </p>
                            <p class="mt-2 text-base/7 text-white">Acompañamos los procesos de aprendizaje en todas las etapas de la vida, identificando fortalezas y apoyando en los desafíos para un desarrollo integral.
                            </p>
                        </div>
                    </div>
                    <div data-aos="fade-up"
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-A2-500 p-8 sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-sm lg:flex-auto lg:flex-col lg:items-start lg:gap-y-30">
                        <p class="flex-none text-3xl font-bold tracking-tight text-gray-900"></p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white">Psicología</p>
                            <p class="mt-2 text-base/7 text-white">Brindamos un espacio seguro y empático para expresarte, comprender tus emociones y trabajar en tu bienestar en cada etapa del ciclo vital.
                            </p>
                        </div>
                    </div>
                    <div data-aos="fade-up"
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-A3-500 p-8 sm:w-11/12 sm:max-w-xl sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-none lg:flex-auto lg:flex-col lg:items-start lg:gap-y-28">
                        <p class="flex-none text-3xl font-bold tracking-tight text-gray-900"></p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white">Fonoaudiología</p>
                            <p class="mt-2 text-base/7 text-white">Potenciamos las habilidades comunicativas desde el lenguaje oral y escrito hasta la voz y la audición, fortaleciendo la capacidad de comunicarse.
                            </p>
                        </div>
                    </div>
                    <div data-aos="fade-up"
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-A4-500 p-8 sm:w-11/12 sm:max-w-xl sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-none lg:flex-auto lg:flex-col lg:items-start lg:gap-y-20">
                        <p class="flex-none text-3xl font-bold tracking-tight text-gray-900"></p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white">Acompañamiento Especializado</p>
                            <p class="mt-2 text-base/7 text-white">Servicio de babysitter profesional que complementa nuestro trabajo multidisciplinario, brindando cuidado y apoyo especializado.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div data-aos="fade-up" class="relative bg-gray-900 rounded-2xl">
            <div
                class="relative h-80 overflow-hidden bg-A1-600 md:absolute md:left-0 md:h-full md:w-1/3 lg:w-1/2 rounded-l-2xl">
                <img class="size-full object-cover" src="{{ asset('images/home/card-3.jpg') }}" alt="">
                <x-layouts.parts.blend-multiply class="opacity-60" />
            </div>
            <div class="relative mx-auto max-w-7xl py-24 sm:py-32 lg:px-8 lg:py-40">
                <div class="pl-6 pr-6 md:ml-auto md:w-2/3 md:pl-16 lg:w-1/2 lg:pl-24 lg:pr-0 xl:pl-32">
                    <h2 class="text-base/7 font-semibold text-A1-400">Equipo Profesional</h2>
                    <p class="mt-2 text-4xl font-semibold tracking-tight text-white sm:text-5xl">Trabajo colaborativo
                        multidisciplinario
                    </p>
                    <p class="mt-6 text-base/7 text-gray-300">
                        Nuestro equipo de profesionales altamente capacitados trabaja de manera colaborativa para brindar una atención integral y personalizada. Cada especialista aporta su experiencia y conocimiento para acompañar a las personas en su proceso de crecimiento y bienestar, creando un espacio donde el aprendizaje y el desarrollo se producen de manera natural y respetuosa.
                    </p>
                    {{-- <div class="mt-8">
                        <a href="{{ route('professionals') }}" wire:navigate
                            class="inline-flex rounded-md bg-A1-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-white/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                            Ver equipo profesional →
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>

        @if(hasTestimonials() && $testimonials->isNotEmpty())
            <section data-aos="fade-up" class="relative isolate  pb-32 pt-24 sm:pt-32">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-base/7 font-semibold text-A1-600">{{ __('Testimonios') }}</h2>
                        <p class="mt-2 text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                            {{ __('Lo que dicen quienes nos eligen') }}
                        </p>
                    </div>
                    <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 text-sm/6 text-gray-900 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:items-start">
                        @foreach($testimonials as $testimonial)
                            <figure class="flex flex-col h-auto rounded-2xl bg-white shadow-lg ring-1 ring-gray-900/5 {{ $loop->index === 1 ? 'p-8 lg:p-10 lg:scale-105' : 'p-6' }}">
                                <blockquote class="flex-1 text-gray-900 {{ $loop->index === 1 ? 'text-lg' : '' }}">
                                    <p>"{{ $testimonial->content }}"</p>
                                </blockquote>
                                <figcaption class="mt-6 flex items-center gap-x-4">
                                    <img src="{{ asset('images/user-test.png') }}" alt="{{ $testimonial->name }}" class="{{ $loop->index === 1 ? 'size-12' : 'size-10' }} rounded-full bg-gray-50 object-cover flex-shrink-0" />
                                    <div>
                                        <div class="font-semibold text-gray-900 {{ $loop->index === 1 ? 'text-base' : '' }}">{{ $testimonial->name }}</div>
                                        @if($testimonial->role)
                                            <div class="text-gray-600 {{ $loop->index === 1 ? 'text-sm' : 'text-xs' }}">{{ $testimonial->role }}</div>
                                        @endif
                                        @if($testimonial->rating)
                                            <div class="text-sm flex items-center gap-x-1 text-amber-500 mt-0.5">
                                                @foreach(range(1, $testimonial->rating) as $star)
                                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="{{ $loop->index === 1 ? 'size-6' : 'size-5' }} flex-none">
                                                        <path d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                                    </svg>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                    @if(hasTestimonials())
                        <div class="mt-12 text-center">
                            <a href="{{ route('testimonials') }}" wire:navigate class="text-base font-semibold text-A1-600 hover:text-A1-500">
                                {{ __('Ver todos los testimonios') }} →
                            </a>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <section data-aos="fade-up">
            <div class="mx-auto max-w-7xl">
                <div
                    class="relative overflow-hidden bg-gray-900 px-6 py-20 shadow-xl sm:rounded-3xl sm:px-10 sm:py-24 md:px-12 lg:px-20">
                    <img class="absolute inset-0 size-full object-cover brightness-150 saturate-0"
                        src="https://cer.cl/wp-content/uploads/2022/06/nuevo-familias-cer-cl-scaled.jpg" alt="">
                    <x-layouts.parts.blend-multiply />
                    <div class="relative mx-auto max-w-2xl lg:mr-0 lg:text-right">
                        <figure>
                            <blockquote class="mt-6 text-lg font-semibold text-white sm:text-xl/8">
                                <p>
                                    JUNTOS, EN EL CAMINO A TU DESARROLLO INTEGRAL.
                                </p>
                            </blockquote>
                            <figcaption class="mt-6 text-base text-white">
                                <div class="font-semibold"> ← Ver Especialidades</div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section data-aos="fade-up">
            <div class="mx-auto max-w-7xl">
                <div
                    class="relative overflow-hidden bg-gray-900 px-6 py-20 shadow-xl sm:rounded-3xl sm:px-10 sm:py-24 md:px-12 lg:px-20">
                    <img class="absolute inset-0 size-full object-cover brightness-150 saturate-0"
                        src="https://cer.cl/wp-content/uploads/2022/06/coches-cer-cl.jpg" alt="">
                    <x-layouts.parts.blend-multiply />
                    <div class="relative mx-auto max-w-2xl lg:mx-0">
                        <figure>
                            <blockquote class="mt-6 text-lg font-semibold text-white sm:text-xl/8">
                                <p>
                                    DESCUBRE TUS POTENCIALIDADES Y DESARROLLA TU MÁXIMO POTENCIAL
                                </p>
                            </blockquote>
                            <figcaption class="mt-6 text-base text-white">
                                <div class="font-semibold">Conoce nuestros servicios →</div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section data-aos="fade-up">
            <div class="px-6 sm:px-6 sm:pb-32 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                        ¿Tienes dudas?</h2>
                    <p class="mx-auto mt-6 max-w-xl text-pretty text-lg/8 text-gray-600">Revisa nuestras preguntas
                        frecuentes y glosario de términos o simplemente escríbenos a
                        <x-layouts.parts.crossed-out>
                            {{ settings('email', 'info@cer.cl') }}
                        </x-layouts.parts.crossed-out></p>
                </div>
            </div>
        </section>
    </div>
</div>
