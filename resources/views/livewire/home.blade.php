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
                            class="rounded-md bg-A1-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-A1-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-A1-600">
                            {{ __('Agendar cita') }}
                        </a>
                        <a href="{{ route('contact') }}" class="text-sm font-semibold leading-6 text-white">
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
                <div class="mx-auto max-w-5xl lg:mx-0">
                    <h2 class="text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                        En <x-layouts.parts.crossed-out>Clinica Cer</x-layouts.parts.crossed-out> somos especialista en
                        tratar los problemas de fertilidad.
                    </h2>
                    <p class="mt-6 text-base/7 text-gray-600">
                        Todos nuestros Ginecólogos poseen la subespecialidad en infertilidad.
                        Estamos acreditados por RED LARA en categoría GOLD, siendo esta la máxima distinción que
                        certifica
                        la excelencia en los procesos y en los resultados de nuestros profesionales, quienes son
                        expertos en
                        técnicas de reproducción asistida de baja y alta complejidad.</p>
                </div>
                <div
                    class="mx-auto mt-16 flex max-w-2xl flex-col gap-8 lg:mx-0 lg:mt-20 lg:max-w-none lg:flex-row lg:items-end">
                    <div
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-A1-500 p-8 sm:w-3/4 sm:max-w-md sm:flex-row-reverse sm:items-end lg:w-72 lg:max-w-none lg:flex-none lg:flex-col lg:items-start">
                        <p class="flex-none text-3xl font-bold tracking-tight text-gray-900"></p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white uppercase">
                                Agenda tu hora en Clínica CER
                            </p>
                            <p class="mt-2 text-base/7 text-white">Somos especialistas en tratar la infertilidad.
                            </p>
                        </div>
                    </div>
                    <div
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-A2-500 p-8 sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-sm lg:flex-auto lg:flex-col lg:items-start lg:gap-y-30">
                        <p class="flex-none text-3xl font-bold tracking-tight text-gray-900"></p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white">BONO PAD FONASA ALTA Y BAJA
                                COMPLEJIDAD</p>
                            <p class="mt-2 text-base/7 text-white">En nuestro país, el 14% de las parejas en edad
                                reproductiva sufren de algún trastorno de fertilidad (Aproximadamente 250.000
                                parejas).</p>
                        </div>
                    </div>
                    <div
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-A3-500 p-8 sm:w-11/12 sm:max-w-xl sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-none lg:flex-auto lg:flex-col lg:items-start lg:gap-y-28">
                        <p class="flex-none text-3xl font-bold tracking-tight text-gray-900"></p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white">PROGRAMA DE OVORECEPCIÓN</p>
                            <p class="mt-2 text-base/7 text-white">Eu duis porta aliquam ornare. Elementum eget
                                magna
                                egestas. Eu duis porta aliquam ornare.</p>
                        </div>
                    </div>
                    <div
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-A4-500 p-8 sm:w-11/12 sm:max-w-xl sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-none lg:flex-auto lg:flex-col lg:items-start lg:gap-y-20">
                        <p class="flex-none text-3xl font-bold tracking-tight text-gray-900"></p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white">QUIERO SER DONANTE</p>
                            <p class="mt-2 text-base/7 text-white">Actualmente en Chile, la tasa de
                                infertilidad oscila
                                entre el 13% y el 15% de la población en edad reproductiva.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative bg-gray-900 rounded-2xl">
            <div
                class="relative h-80 overflow-hidden bg-A1-600 md:absolute md:left-0 md:h-full md:w-1/3 lg:w-1/2 rounded-l-2xl">
                <img class="size-full object-cover" src="{{ asset('images/home/card-3.jpg') }}" alt="">
                <x-layouts.parts.blend-multiply class="opacity-60" />
            </div>
            <div class="relative mx-auto max-w-7xl py-24 sm:py-32 lg:px-8 lg:py-40">
                <div class="pl-6 pr-6 md:ml-auto md:w-2/3 md:pl-16 lg:w-1/2 lg:pl-24 lg:pr-0 xl:pl-32">
                    <h2 class="text-base/7 font-semibold text-A1-400">Equipo Profesional</h2>
                    <p class="mt-2 text-4xl font-semibold tracking-tight text-white sm:text-5xl">¡La experiencia nos
                        avala!
                    </p>
                    <p class="mt-6 text-base/7 text-gray-300">
                        Nuestros profesionales se han dedicado por más de 30 años a investigar, estudiar y tratar
                        los
                        problemas de fertilidad. Hemos construido un lugar accesible a todas las personas que así lo
                        necesitan. Nuestras tasas de éxito se destacan por sobre el promedio Nacional e
                        Internacional.
                    </p>
                    <div class="mt-8">
                        <a href="#"
                            class="inline-flex rounded-md bg-A1-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-white/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                            Ver equipo profesional →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="mx-auto max-w-7xl">
                <div
                    class="relative overflow-hidden bg-gray-900 px-6 py-20 shadow-xl sm:rounded-3xl sm:px-10 sm:py-24 md:px-12 lg:px-20">
                    <img class="absolute inset-0 size-full object-cover brightness-150 saturate-0"
                        src="https://cer.cl/wp-content/uploads/2022/01/manos-cer-cl.jpg" alt="">
                    <x-layouts.parts.blend-multiply />
                    <div class="relative mx-auto max-w-2xl lg:mx-0">
                        <figure>
                            <blockquote class="mt-6 text-lg font-semibold text-white sm:text-xl/8">
                                <p>
                                    ESTAMOS CONTIGO EN CADA ETAPA DEL PROCESO
                                </p>
                            </blockquote>
                            <figcaption class="mt-6 text-base text-white">
                                <div class="font-semibold">Ver Testimonios→</div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section>
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
                                    JUNTOS, EN EL CAMINO A FORMAR TU FAMILIA.
                                </p>
                            </blockquote>
                            <figcaption class="mt-6 text-base text-white">
                                <div class="font-semibold"> ← Ver Tratamientos</div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section>
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
                                    JUNTOS FORMAREMOS TU PROPIO MODELO DE FAMILIA
                                </p>
                            </blockquote>
                            <figcaption class="mt-6 text-base text-white">
                                <div class="font-semibold">Ver modelos de familias→</div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="px-6 sm:px-6 sm:pb-32 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                        ¿Tienes dudas?</h2>
                    <p class="mx-auto mt-6 max-w-xl text-pretty text-lg/8 text-gray-600">Revisa nuestras preguntas
                        frecuentes y glosario de términos o simplemente escríbenos a
                        <x-layouts.parts.crossed-out>info@cer.cl</x-layouts.parts.crossed-out></p>
                </div>
            </div>
        </section>
    </div>
</div>
