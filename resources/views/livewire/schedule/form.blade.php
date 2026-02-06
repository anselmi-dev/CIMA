<div x-data="{
    isOpen: @entangle('isOpen')
}" x-init="$watch('isOpen', (value) => value ? document.body.classList.add('overflow-hidden') : document.body.classList.remove('overflow-hidden'))" @keydown.escape="isOpen = false" class="relative z-50"
    aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 backdrop-blur-sm bg-white/30" aria-hidden="true" x-show="isOpen"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <div class="fixed inset-0 overflow-hidden" x-show="isOpen"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <div class="pointer-events-auto w-screen max-w-md" x-show="isOpen"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                    @if ($current)
                        <form @submit.prevent="submit()"
                            class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl">
                            <div class="h-0 flex-1 overflow-y-auto">
                                <div class="bg-A1-500 px-4 py-6 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex gap-1 flex-col">
                                            <h2 class="text-base font-semibold text-white" id="slide-over-title">
                                                Detalles de la reserva
                                            </h2>
                                            <p>
                                                {{ $current->professional->is_presence ? 'Presencial' : 'Telemedicina' }}
                                            </p>
                                        </div>
                                        <div class="ml-3 flex h-7 items-center">
                                            <button type="button"
                                                class="relative rounded-md bg-A1-700 text-A1-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                                                @click="isOpen = false">
                                                <span class="absolute -inset-2.5"></span>
                                                <span class="sr-only">Close panel</span>
                                                <svg class="size-6" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                                    data-slot="icon">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18 18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="text-sm text-A1-300">
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-1 flex-col justify-between">
                                    <div class="divide-y divide-gray-200 px-4 sm:px-6">
                                        <div class="space-y-6 pb-5 pt-6">
                                            <div class="relative flex gap-x-6 xl:static">
                                                <img src="{{ $current->professional->user->profile_photo_url }}" alt="{{ $current->professional->full_name }}"
                                                    class="size-14 flex-none rounded-full bg-white">

                                                <div class="flex-auto">
                                                    <h3 class="pr-10 font-semibold text-lg text-gray-900 xl:pr-0">
                                                        {{ $current->professional->full_name }}
                                                    </h3>
                                                    <dl class="text-base flex flex-col text-gray-500 xl:flex-row">
                                                        <div class="flex items-start gap-x-3 flex-col">
                                                            <dd>
                                                                <span>{{ $current->professional->medicalSpecialties->first()->name }}</span>
                                                            </dd>
                                                            @if ($current->professional->consultation_fee !== null)
                                                                <dd class="font-semibold text-gray-900">
                                                                    {{ \Illuminate\Support\Number::currency($current->professional->consultation_fee, 'CLP') }}
                                                                </dd>
                                                            @endif
                                                        </div>
                                                    </dl>
                                                </div>
                                            </div>

                                            <dl class="grid grid-cols-2 gap-0.5 overflow-hidden rounded-md text-center">
                                                <div class="flex flex-col bg-gray-300 p-2">
                                                    <dt class="text-sm/6 font-semibold text-gray-600">
                                                        {{ $current->date->format('d-m-Y') }}
                                                    </dt>
                                                    <dd
                                                        class="order-first text-2xl font-semibold tracking-tight text-white flex justify-center">
                                                        <svg class="size-8" xmlns="http://www.w3.org/2000/svg"
                                                            enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                                            fill="currentColor">
                                                            <g>
                                                                <rect fill="none" height="24" width="24">
                                                                </rect>
                                                            </g>
                                                            <g>
                                                                <rect height="2" opacity=".3" width="14" x="5"
                                                                    y="6"></rect>
                                                                <path
                                                                    d="M19,4h-1V2h-2v2H8V2H6v2H5C3.89,4,3.01,4.9,3.01,6L3,20c0,1.1,0.89,2,2,2h14c1.1,0,2-0.9,2-2V6C21,4.9,20.1,4,19,4z M19,20 H5V10h14V20z M19,8H5V6h14V8z M9,14H7v-2h2V14z M13,14h-2v-2h2V14z M17,14h-2v-2h2V14z M9,18H7v-2h2V18z M13,18h-2v-2h2V18z M17,18 h-2v-2h2V18z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </dd>
                                                </div>
                                                <div class="flex flex-col bg-gray-300 p-2">
                                                    <dt class="text-sm/6 font-semibold text-gray-600">
                                                        {{ $current->date->format('h:i') }}
                                                    </dt>
                                                    <dd
                                                        class="order-first text-2xl font-semibold tracking-tight text-white flex justify-center">
                                                        <svg class="size-8" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24">
                                                            <g fill="none" stroke="currentColor" stroke-width="1.2">
                                                                <circle cx="12" cy="12" r="8.6"
                                                                    fill="currentColor" fill-opacity=".25"></circle>
                                                                <path stroke-linecap="round"
                                                                    d="M16.5 12h-4.25a.25.25 0 0 1-.25-.25V8.5"></path>
                                                            </g>
                                                        </svg>
                                                    </dd>
                                                </div>
                                            </dl>

                                            <div class="flex flex-col space-y-4">
                                                <div>
                                                    <label for="phone"
                                                        class="block text-xs font-medium text-gray-500">RUT</label>
                                                    <div class="mt-1 flex items-center gap-x-3">
                                                        <input type="text" name="dni" id="dni"
                                                            placeholder="Documento" wire:model="reservation.dni"
                                                            class="flex-1 w-full block rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-A1-600 sm:text-sm"
                                                            placeholder="123456789">
                                                    </div>
                                                </div>

                                                <div class="flex flex-row space-x-4">
                                                    <div class="w-full">
                                                        <label for="name"
                                                            class="block text-xs font-medium text-gray-500">Nombre</label>
                                                        <div class="mt-2">
                                                            <input type="text" name="name" id="name"
                                                                wire:model="reservation.name" placeholder="Nombre"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-A1-600 sm:text-sm">
                                                        </div>
                                                    </div>

                                                    <div class="w-full">
                                                        <label for="last_name"
                                                            class="block text-xs font-medium text-gray-500">Apellido</label>
                                                        <div class="mt-2">
                                                            <input type="text" name="last_name" id="last_name"
                                                                wire:model="reservation.last_name" placeholder="Apellido"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-A1-600 sm:text-sm">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="birthdate"
                                                        class="block text-xs font-medium text-gray-500">Fecha de nacimiento</label>
                                                    <div class="mt-1 flex items-center gap-x-3">
                                                        <select id="birthdate-day" name="birthdate-day"
                                                            placeholder="Fecha de nacimiento"
                                                            wire:model="reservation.birthdate_day"
                                                            class="block w-20 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-A1-600 sm:text-sm">
                                                            <option value="">--</option>
                                                            @for ($i = 1; $i <= 31; $i++)
                                                                <option value="{{ $i }}">{{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        <select id="birthdate-month" name="birthdate-month"
                                                            wire:model="reservation.birthdate_month"
                                                            class="block w-20 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-A1-600 sm:text-sm">
                                                            <option value="">--</option>
                                                            @for ($i = 1; $i <= 12; $i++)
                                                                <option value="{{ $i }}">{{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        <select id="birthdate-year" name="birthdate-year"
                                                            wire:model="reservation.birthdate_year"
                                                            class="block w-20 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-A1-600 sm:text-sm">
                                                            <option value="">--</option>
                                                            @for ($i = 1900; $i <= date('Y'); $i++)
                                                                <option value="{{ $i }}">
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="email"
                                                        class="block text-xs font-medium text-gray-500">Correo
                                                        electrónico</label>
                                                    <div class="mt-2">
                                                        <input type="email" name="email" id="email"
                                                            wire:model="reservation.email" placeholder="tu@correo"
                                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-A1-600 sm:text-sm">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="phone"
                                                        class="block text-xs font-medium text-gray-500">Número de
                                                        teléfono</label>
                                                    <div class="mt-1 flex items-center gap-x-3">
                                                        <div class="flex items-center gap-x-1">
                                                            <span
                                                                class="text-sm font-semibold text-gray-900">+56</span>
                                                            <input type="text" name="phone" id="phone"
                                                                wire:model="reservation.phone"
                                                                placeholder="Número de teléfono"
                                                                class="block w-40 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-A1-600 sm:text-sm"
                                                                placeholder="123456789">
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($errors->any())
                                                    <div class="rounded-md bg-red-50 p-4">
                                                        <div class="flex">
                                                          <div class="shrink-0">
                                                            <svg class="size-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                              <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                                                            </svg>
                                                          </div>
                                                          <div class="ml-3">
                                                            <h3 class="text-sm font-medium text-red-800">Hubo {{ $errors->count() }} errores con tu envio</h3>
                                                            <div class="mt-2 text-sm text-red-700">
                                                              <ul role="list" class="list-disc space-y-1 pl-5">
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                              </ul>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex shrink-0 justify-end px-4 py-4">
                                <button type="button"
                                    class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                    @click="isOpen = false">
                                    Cancel
                                </button>
                                <button type="submit"
                                    wire:click="submit()"
                                    wire:loading.attr="disabled"
                                    class="ml-4 inline-flex justify-center rounded-md bg-A1-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-A1-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-A1-600">
                                    <span>Reservar</span>
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
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
