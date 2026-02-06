<div class="h-min-screen w-full max-w-full relative isolate overflow-hidden bg-gray-900 pt-14 pb-16 sm:pb-20 min-h-screen | flex items-center   ">

    <x-layouts.parts.blend-multiply class="opacity-90"></x-layouts.parts.blend-multiply>

    <img src="https://cer.masterkey.cl/acliente/assets/img/homeAgenda.jpg" alt=""
        class="absolute inset-0 -z-10 size-full object-cover">

    <div class="mx-auto max-w-7xl px-6 lg:px-8 z-1 relative py-20 space-y-6 flex flex-col">

        <div class="mx-auto max-w-2xl">
            <div class="text-center">
                <h1 class="text-5xl font-semibold tracking-tight text-balance text-white sm:text-7xl">
                    Agenda tu hora en Clínica CER
                    <x-layouts.parts.crossed-out>Clínica CER</x-layouts.parts.crossed-out>
                </h1>
                <p class="mt-8 text-lg font-medium text-pretty text-gray-400 sm:text-xl/8">
                    Somos especialistas en tratar la infertilidad.</p>
                <form wire:submit.prevent="submit" class="mt-10 items-center gap-3 grid grid-cols-1 md:grid-cols-3">
                    <select wire:model="medicalSpecialtyId"
                        class="w-full max-w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-A1-600 sm:text-sm/6">
                        @if (!$medicalSpecialtyId)
                            <option value="">Especialidad</option>
                        @endif
                        @foreach ($medicalSpecialties as $medicalSpecialty)
                            <option value="{{ $medicalSpecialty->id }}">{{ $medicalSpecialty->name }}</option>
                        @endforeach
                    </select>

                    <select wire:model="type"
                        class="w-full max-w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-A1-600 sm:text-sm/6">
                        <option value="presencial">Presencial</option>
                        <option value="telemedicina">Telemedicina</option>
                    </select>

                    <button type="submit" class="w-full rounded-md bg-A1-500 px-5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-A1-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-A1-600">
                        <span>Buscar horarios</span>
                        <svg wire:loading wire:target="submit"
                            class="animate-spin mx-auto h-4 w-4 text-A1-600"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </button>
                </form>

                <x-errors :errors="$errors" class="mt-5 flex items-center justify-center gap-x-3 bg-white/10 p-4 rounded-md" />
            </div>
        </div>

        <div class="flex sm:justify-center mx-auto max-w-2xl">
            <div
                class="relative rounded-full px-6 py-1 text-sm/6 text-gray-400 _ring-1 ring-white/10 hover:ring-white/20 text-center">
                Si no encuentra una hora médica que se ajuste a sus necesidades, por favor escriba a <x-contact-email /> y le ayudaremos con su
                requerimiento.
            </div>
        </div>
    </div>
</div>
