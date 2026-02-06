<div class="max-w-7xl mx-auto px-6 lg:px-8 py-24 sm:py-32 min-h-screen">
    <div class="border-b border-gray-100 mb-5 pb-5">
        <div>
            <nav class="hidden sm:flex" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div class="flex">
                            <a href="{{ route('home') }}"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700">Inicio</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="size-5 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <a href="{{ route('schedule.index') }}"
                                class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Especialidad</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="size-5 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <a href="#" aria-current="page"
                                class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Agenda</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl/7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Agenda tu hora para <strong>{{ $medicalSpecialty->name }}</strong>
                </h2>
            </div>
            <div class="mt-4 flex shrink-0 md:ml-4 md:mt-0">
            </div>
        </div>

        <div class="mt-4 flex items-center w-full justify-center">
            <div x-data="{
                    type: @entangle('type'),
                    loading: false
                }"
                x-init="$watch('type', value => {
                    $wire.set('type', value)
                    window.history.pushState({}, '', `?tipo=${value}`)
                })"
                x-show="!loading"
                class="mx-8 shadow rounded-full h-10 mt-4 flex p-1 items-center z-1 relative bg-white w-[300px] max-w-full">
                <div class="z-50 w-full flex justify-center">
                    <button type="button" @click="type = 'presencial'" class="text-gray-900" :class="type === 'presencial' ? 'font-semibold text-white' : ''">Presencial</button>
                </div>
                <div class="z-50 w-full flex justify-center">
                    <button type="button" @click="type = 'telemedicina'" class="text-gray-900" :class="type === 'telemedicina' ? 'font-semibold text-white' : ''">Telemedicina</button>
                </div>
                <span class="z-10 bg-A1-600 shadow flex items-center justify-center w-1/2 rounded-full h-8 transition-all top-[4px] absolute left-1 "
                    :class="type === 'telemedicina' ? 'left-1/2' : 'left-1'">
                </span>
            </div>
        </div>

    </div>

    <div class="lg:grid lg:grid-cols-12 lg:gap-x-16">
        <div class="text-center lg:col-start-8 lg:col-end-13 lg:row-start-1 lg:mt-9 xl:col-start-9 relative">
            <div class="text-center">
                <div class="flex items-center justify-center text-gray-900">
                    <button wire:click="prevMonth"
                        class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Previous month</span>
                        <svg wire:target="prevMonth" wire:loading.class="hidden" class="size-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd"></path>
                        </svg>

                        <x-loading-spinner wire:loading wire:target="prevMonth" class="mx-auto h-5 w-5 text-A1-600" />

                    </button>
                    <div class="flex-auto text-sm font-semibold capitalize">
                        {{ \Carbon\Carbon::create($currentYear, $currentMonth)->locale('es_ES')->translatedFormat('F Y') }}
                    </div>
                    <button wire:click="nextMonth"
                        class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Next month</span>
                        <svg wire:target="nextMonth" wire:loading.class="hidden" class="size-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd"></path>
                        </svg>

                        <x-loading-spinner wire:loading wire:target="nextMonth" class="mx-auto h-5 w-5 text-A1-600" />

                    </button>
                </div>

                <div class="mt-6 grid grid-cols-7 text-xs text-gray-500">
                    <div>DOM</div>
                    <div>LUN</div>
                    <div>MAR</div>
                    <div>MIE</div>
                    <div>JUE</div>
                    <div>VIE</div>
                    <div>SAB</div>
                </div>

                <div
                    class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm ring-1 shadow-sm ring-gray-200">
                    @foreach ($dates as $day)
                        @php
                            $selected = $day['date']->toDateString() == ($startDate ? $startDate->toDateString() : '');
                            $disabled = !$day['date']->gt(now()->subDays(1));
                        @endphp

                        <button
                            type="button"
                            @if (!$disabled)
                                wire:click="selectDate('{{ $day['date']->toDateString() }}')"
                                wire:loading.class="opacity-50 cursor-not-allowed"
                                wire:loading.attr="disabled"
                            @endif
                            @class([
                                'py-1.5 focus:z-10 relative',
                                'hover:bg-gray-100' => !$disabled,
                                'font-semibold bg-A1-500 text-white hover:bg-A1-600' => $selected && !$disabled,
                                'bg-white text-gray-900'   =>  $day['currentMonth'] && !$selected && !$disabled,
                                'bg-gray-50 text-gray-400' =>  !$day['currentMonth'] && !$selected && !$disabled,
                                'bg-gray-100 pointer-events-none cursor-not-allowed' => $disabled
                            ])>

                            @if ($disabled)
                                <span aria-hidden="true" class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200">
                                    <svg class="absolute inset-0 size-full stroke-2 text-gray-200" viewBox="0 0 100 100" preserveAspectRatio="none" stroke="currentColor">
                                        <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke"></line>
                                    </svg>
                                </span>
                            @endif
                            <time datetime="{{ $day['date']->toDateString() }}" wire:loading.class="hidden"
                                wire:target="selectDate('{{ $day['date']->toDateString() }}')"
                                class="mx-auto flex size-7 items-center justify-center rounded-full">
                                {{ $day['date']->day }}
                            </time>

                            <x-loading-spinner wire:loading wire:target="selectDate('{{ $day['date']->toDateString() }}')"
                                class="mx-auto h-5 w-5 text-A1-600" />

                        </button>
                    @endforeach
                </div>
            </div>
            <div class="text-sm text-gray-500">
                <p class="mt-4">
                    Recuerda que debes agendar tu cita al menos 3 horas antes de la hora de inicio.
                </p>
                <p class="mt-2">
                    Cualquier duda, por favor no dude en <a href="{{ route('contact') }}" class="text-A1-600 hover:underline">contactarnos</a>.
                </p>
            </div>
        </div>

        <ol class="mt-4 divide-y divide-gray-100 text-sm/6 lg:col-span-7 xl:col-span-8">
            @forelse ($this->professionals as $professional)
                <li class="mb-4">
                    <div class="relative flex gap-x-6 py-6 xl:static">
                        <img src="{{ $professional->user->profile_photo_url }}" alt="{{ $professional->full_name }}"
                            class="size-14 lg:size-20 flex-none rounded-full bg-white">

                        <div class="flex-auto">
                            <h3 class="pr-10 font-semibold text-lg text-gray-900 xl:pr-0">
                                {{ $professional->full_name }}
                            </h3>
                            <dl class="text-base flex flex-col text-gray-500 xl:flex-row">
                                <div class="flex items-start gap-x-3 flex-col">
                                    <dd>
                                        <span>{{ $professional->medicalSpecialties->first()->name }}</span>
                                    </dd>
                                    @if ($professional->consultation_fee !== null)
                                        <dd class="font-semibold text-gray-900">
                                            {{ \Illuminate\Support\Number::currency($professional->consultation_fee, 'CLP') }}
                                        </dd>
                                    @endif
                                </div>
                            </dl>
                        </div>
                    </div>
                    <div>
                        <div class="grid grid-cols-5 md:grid-cols-7 gap-2 mt-2">
                            @foreach ($professional->schedules as $schedule)
                                @foreach ($schedule->time as $time)
                                    @php
                                        $datetime = \Carbon\Carbon::createFromFormat('H', $time);
                                        $dateStartDate = $this->startDate->copy()->setTimeFromTimeString($time);
                                        $slotKey = trim($professional->id . '|' . $dateStartDate->format('Y-m-d H'));
                                        // Solo habilitar si el slot no está tomado por una cita activa (pending/confirmed). Las canceladas no bloquean.
                                        $slotTakenByActiveAppointment = $this->appointments->contains($slotKey);
                                        $isAvailable = !$slotTakenByActiveAppointment && $dateStartDate->gt(now()->addHours(3));
                                    @endphp

                                    <button x-data="{ loading: false }" type="button"
                                        @if ($isAvailable)
                                            @click="loading = true; $wire.selectTime({{ $schedule->id }}, '{{ $dateStartDate->toDateTimeString() }}'); setTimeout(() => loading = false, 1000)"
                                        @else
                                            disabled
                                        @endif
                                        @class([
                                            "rounded-md py-1 px-2 relative",
                                            'bg-A1-500 text-white hover:bg-A1-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 ' => $isAvailable,
                                            'bg-white text-gray-300 cursor-not-allowed' => !$isAvailable
                                        ])>
                                        @if (!$isAvailable)
                                            <span aria-hidden="true" class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200">
                                                <svg class="absolute inset-0 size-full stroke-2 text-gray-200" viewBox="0 0 100 100" preserveAspectRatio="none" stroke="currentColor">
                                                    <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke"></line>
                                                </svg>
                                            </span>
                                        @endif

                                        <span :class="{ 'opacity-0': loading }">
                                            {{ $datetime->format('H:i') }}
                                        </span>
                                        <span x-show="loading" class="mx-auto absolute top-0 left-0 right-0 bottom-0 m-auto flex items-center justify-center">
                                            <x-loading-spinner class="h-5 w-5 text-gray-800" />
                                        </span>
                                    </button>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </li>
            @empty
                <li>
                    <main class="grid min-h-full place-items-center px-6 py-24 sm:py-32 lg:px-8">
                        <div class="text-center">
                            <h1
                                class="mt-2 text-balance text-1xl font-semibold tracking-tight text-gray-900 sm:text-3xl">
                                No se encontraron horarios
                            </h1>
                            <p class="mt-2 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">
                                No se encontraron horarios para la especialidad seleccionada.
                            </p>
                            <div class="mt-3 flex items-center justify-center gap-x-6">
                                <button wire:click="nextScheduleAvailable"
                                    wire:loading.class="opacity-50 cursor-not-allowed"
                                    wire:loading.attr="disabled"
                                    class="rounded-md bg-A1-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-A1-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-A1-600">

                                    <x-loading-spinner wire:loading wire:target="nextScheduleAvailable" />
                                    <span>Ver horarios disponibles próximos</span>
                                </button>
                            </div>
                        </div>
                    </main>
                </li>
            @endforelse
        </ol>
    </div>

    @include('livewire.schedule.form')
</div>
