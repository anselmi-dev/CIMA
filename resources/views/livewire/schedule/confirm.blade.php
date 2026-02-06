<x-container.page  >
    <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
        <div class="mx-auto max-w-2xl px-4 lg:max-w-4xl lg:px-2">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                Agenda de pendiente de {{ $appointment->medicalSpecialty->name }}
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                La cita con el profesional <strong>{{ $appointment->professional->full_name }}</strong> está programada
                para el <strong>{{ $appointment->start_at->format('d/m/Y') }}</strong> a las
                <strong>{{ $appointment->start_at->format('H:i') }}</strong>. La cita está pendiente de confirmación.
                Recuerda que la cita se cancelará automáticamente al pasar 3 horas desde que se agendó si no se
                confirma.
            </p>
        </div>
    </div>

    <div x-data="{
            openCancel: false,
            init() {
                this.$watch('openCancel', value => {
                    document.body.style.overflow = value ? 'hidden' : '';
                });
            }
        }">
        <section aria-labelledby="recent-heading" class="mt-10">
            <h2 id="recent-heading" class="sr-only">Recent orders</h2>
            <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
                <div class="mx-auto max-w-2xl space-y-8 sm:px-4 lg:max-w-4xl lg:px-0">
                    <div class="border-t border-b border-gray-200 bg-white shadow-xs sm:rounded-lg sm:border">
                        <h3 class="sr-only">Order placed on <time datetime="2021-07-06">Jul 6, 2021</time></h3>
                        <!-- Products -->
                        <h4 class="sr-only">Items</h4>
                        <ul role="list" class="divide-y divide-gray-200">
                            <li class="p-4 sm:p-6">
                                <div class="flex items-center sm:items-start">
                                    <div class="size-20 shrink-0 overflow-hidden rounded-lg bg-gray-200 sm:size-40">
                                        <img src="{{ $appointment->professional->user->profile_photo_url }}"
                                            alt="{{ $appointment->professional->full_name }}"
                                            class="size-full object-cover">
                                    </div>
                                    <div class="ml-6 flex-1 text-sm flex flex-col justify-between">
                                        <div class="font-medium text-gray-900 sm:flex sm:justify-between flex-col">
                                            <h5 class="text-xl">
                                                {{ $appointment->professional->full_name }}
                                            </h5>
                                            <p class="text-base mt-2 sm:mt-0">
                                                {{ $appointment->medicalSpecialty->name }}
                                            </p>
                                        </div>
                                        <div class="mt-8">
                                            <dl class="grid grid-cols-2 gap-0.5 overflow-hidden rounded-md text-center">
                                                <div class="flex flex-col bg-A1-500 p-2">
                                                    <dt class="text-sm/6 font-semibold text-white">
                                                        {{ $appointment->start_at->format('d-m-Y') }}
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
                                                <div class="flex flex-col bg-A1-500 p-2">
                                                    <dt class="text-sm/6 font-semibold text-white">
                                                        {{ $appointment->start_at->format('H:i') }}
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
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-span-full | flex flex-col gap-4">
                        <div class="lg:px-2 flex flex-row gap-1">
                            <div>
                                <span class="bg-A1-500 text-white rounded-full w-10 h-10 flex items-center justify-center">1</span>
                            </div>
                            <div>
                                <div class="block text-xl font-medium text-gray-900">
                                    Datos para la transferencia.
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    Seleccione la cuenta bancaria de la que desea realizar la transferencia y suba el comprobante de pago.
                                </p>
                            </div>
                        </div>

                        <div class="w-full | flex flex-col gap-4 lg:px-3">
                            @foreach ($bankAccounts as $bankAccount)
                                <div class="flex-1 py-5 border-t border-gray-200">
                                    <div class="block text-xl font-medium text-gray-900">
                                        {{ $bankAccount->bank_details['full_name'] }}
                                    </div>
                                    <div class="block text-xl font-medium text-gray-900">
                                        {{ $bankAccount->bank_details['rut'] }}
                                    </div>
                                    <div class="block text-xl font-medium text-gray-900">
                                        {{ $bankAccount->bank_details['email'] }}
                                    </div>
                                    <div class="mt-2 text-sm text-gray-500">
                                        {{ $bankAccount->bank_details['account_number'] }}
                                    </div>
                                    @if ($bankAccount->notes)
                                        <div class="mt-2 text-sm text-gray-500">
                                            {{ $bankAccount->notes }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <form wire:submit="submit" class="space-y-8">
                        <div class="col-span-full">
                            <div class="lg:px-2 flex flex-row gap-1">
                                <div>
                                    <span class="bg-A1-500 text-white rounded-full w-10 h-10 flex items-center justify-center">2</span>
                                </div>
                                <div>
                                    <div class="block text-xl font-medium text-gray-900">
                                        Foto del comprobante
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        Por favor, sube la foto del comprobante de pago de la cita. Asegurate de que sea claramente visible el nombre del profesional, la fecha y hora de la cita, y el monto pagado.
                                    </p>
                                </div>
                            </div>

                            @php
                                $receiptMaxSizeMb = (int) ($receiptMaxSizeKb / 1024);
                            @endphp
                            <div class="mt-2 relative"
                                x-data="{
                                    isDragging: false,
                                    dropError: '',
                                    maxSizeBytes: {{ $receiptMaxSizeKb * 1024 }},
                                    allowedTypes: @js($receiptAcceptedMimes),
                                    handleDrop(event) {
                                        this.dropError = '';
                                        const file = event.dataTransfer?.files?.[0];
                                        if (!file) return;
                                        if (file.size > this.maxSizeBytes) {
                                            this.dropError = '{{ __('El archivo no puede superar') }} {{ $receiptMaxSizeMb }} MB.';
                                            return;
                                        }
                                        if (!this.allowedTypes.includes(file.type)) {
                                            this.dropError = '{{ __('Solo se permiten archivos PNG, JPG o PDF.') }}';
                                            return;
                                        }
                                        $wire.upload('receipt', file);
                                    }
                                }"
                                @dragover.prevent="isDragging = true"
                                @dragleave.prevent="isDragging = false"
                                @drop.prevent="handleDrop($event); isDragging = false">
                                <label
                                    for="receipt"
                                    class="cursor-pointer flex justify-center rounded-lg border px-6 py-10 bg-white transition-colors {{ $receipt ? 'border-green-300 bg-green-50/50 ring-1 ring-green-200' : ($errors->has('receipt') ? 'border-red-500 ring-1 ring-red-500 border-dashed' : 'border-dashed border-gray-900/25') }}"
                                    :class="{ 'ring-2 ring-A1-500 bg-A1-50/30 border-A1-400': isDragging }">
                                    <div class="text-center w-full relative">
                                        {{-- Loading overlay --}}
                                        <div wire:loading wire:target="receipt" class="absolute inset-0 flex items-center justify-center rounded-lg bg-white/80 z-10">
                                            <div class="flex flex-col items-center gap-2">
                                                <x-loading-spinner class="size-10 text-A1-600" />
                                                <span class="text-sm font-medium text-gray-700">{{ __('Subiendo...') }}</span>
                                            </div>
                                        </div>

                                        @if ($receipt)
                                            <div class="flex flex-col items-center gap-3">
                                                <span class="flex size-12 items-center justify-center rounded-full bg-green-100 text-green-600">
                                                    <svg class="size-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                    </svg>
                                                </span>
                                                <p class="text-sm font-semibold text-gray-900">{{ __('Documento cargado') }}</p>
                                                <p class="text-sm text-gray-700 break-all px-2">{{ $receipt->getClientOriginalName() }}</p>
                                                <span for="receipt" class="text-sm font-medium text-A1-600 hover:text-A1-500 cursor-pointer focus-within:ring-2 focus-within:ring-A1-600 focus-within:ring-offset-2 rounded">
                                                    {{ __('Cambiar archivo') }}
                                                    <input id="receipt" type="file" wire:model="receipt" class="sr-only" accept=".jpg,.jpeg,.png,.pdf">
                                                </span>
                                            </div>
                                        @else
                                            <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                                aria-hidden="true" data-slot="icon">
                                                <path fill-rule="evenodd"
                                                    d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="mt-4 flex text-sm/6 text-gray-600 justify-center gap-1 flex-wrap">
                                                <span for="receipt"
                                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-A1-600 focus-within:ring-2 focus-within:ring-A1-600 focus-within:ring-offset-2 hover:text-A1-500">
                                                    <span>{{ __('Sube un archivo') }}</span>
                                                    <input id="receipt" type="file" wire:model="receipt" class="sr-only" accept=".jpg,.jpeg,.png,.pdf">
                                                </span>
                                                <span>{{ __('o arrastra y suelta') }}</span>
                                            </div>
                                            <p class="text-xs/5 text-gray-600 mt-1">PNG, JPG, PDF {{ __('hasta') }} {{ $receiptMaxSizeMb }} MB</p>
                                        @endif
                                    </div>
                                </label>
                                <p x-show="dropError" x-text="dropError" x-cloak class="mt-1.5 text-sm text-red-600"></p>
                            </div>
                            @error('receipt')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-full" x-data="{ len: {{ strlen($note ?? '') }} }">
                            <label for="note" class="block text-sm/6 font-medium text-gray-900 lg:px-2">Nota o observación</label>
                            <div class="mt-2">
                                <textarea wire:model="note"
                                    @input="len = $event.target.value.length"
                                    id="note" name="note" rows="3" maxlength="500"
                                    placeholder="Escribe una nota o observación si es necesario."
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 {{ $errors->has('note') ? 'outline-red-500' : '' }}"></textarea>
                            </div>
                            <p class="mt-1 text-sm text-gray-500 lg:px-2">
                                <span x-text="len + '/500'"></span>
                            </p>
                            @error('note')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-full">
                            <div class="flex items-center gap-x-3 lg:px-2">
                                <input id="terms_accepted" type="checkbox" wire:model="terms_accepted"
                                    class="relative size-4 rounded border border-gray-300 bg-white text-A1-600 focus:ring-A1-600 focus:ring-offset-0 {{ $errors->has('terms_accepted') ? 'border-red-500' : '' }}">
                                <label for="terms_accepted" class="block text-sm/6 font-medium text-gray-900">
                                    @if (hasTermsAndConditions())
                                        Acepto los <a href="{{ route('terms-and-conditions') }}" wire:navigate target="_blank" class="text-A1-600 hover:underline">términos y condiciones</a> y la confirmación de la reserva.
                                    @else
                                        Acepto los términos y condiciones y la confirmación de la reserva.
                                    @endif
                                </label>
                            </div>
                            @error('terms_accepted')
                                <p class="mt-1.5 text-sm text-red-600 lg:px-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="button" x-on:click="openCancel = true"
                                class="text-sm/6 font-semibold text-gray-900 hover:text-red-600">
                                {{ __('Cancelar reserva') }}
                            </button>
                            <button type="submit" wire:loading.attr="disabled"
                                class="rounded-md bg-A1-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-A1-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-A1-600 disabled:opacity-70">
                                <span wire:loading.remove wire:target="submit">{{ __('Enviar comprobante') }}</span>
                                <span wire:loading wire:target="submit">{{ __('Enviando...') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="text-center">
                    <p class="mt-4 text-sm text-gray-500">
                        Si tienes alguna duda o problema, por favor no dudes en <a href="{{ route('contact') }}"
                            class="text-indigo-600 hover:underline">contactarnos</a>.
                    </p>
                </div>
            </div>
        </section>
        <div
            x-cloak
            x-show="openCancel"
            class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
            x-show="openCancel"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            >
            <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        x-show="openCancel"
                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                        <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">
                            Cancelar la reserva
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                ¿Estás seguro de cancelar la reserva de tu cita?
                            </p>
                        </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button
                            type="button"
                            wire:loading.attr="disabled"
                            wire:click="cancelReservation"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 gap-1 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                            <x-loading-spinner class="size-4 text-white" wire:loading wire:target="cancelReservation" />
                            <span>Cancelar reserva</span>
                        </button>
                        <button type="button"
                            wire:loading.attr="disabled"
                            x-on:click="openCancel = false"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                            No, no quiero cancelar
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-container.page>
