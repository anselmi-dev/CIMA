<div
    x-data="{
        openCancel: false
    }"
    class="bg-white px-4 pb-24 pt-16 sm:px-6 sm:pt-24 lg:px-8 lg:py-32 min-h-screen">
    <div class="mx-auto max-w-7xl">
        <div class="mx-auto max-w-3xl text-center">
            <h1 class="font-medium text-A1-600 text-4xl mb-2">¡Se ha generado tu reserva!</h1>
            <p class="mt-2 text-base text-gray-500">
                Hemos enviado un correo con los detalles de la reserva y las instrucciones para completar el pago. Puedes realizar la transferencia y enviarnos el comprobante para confirmar tu reserva.
            </p>
            <p class="mt-2 text-base text-gray-500">
                Si no encuentras el correo en tu bandeja de entrada, revisa la carpeta de spam o contáctanos para recibir asistencia.
            </p>
            {{-- 
            <dl class="mt-12 text-sm font-medium">
                <dt class="text-gray-900">Tracking number</dt>
                <dd class="mt-2 text-indigo-600">51547878755545848512</dd>
            </dl>
            --}}
        </div>

        <section aria-labelledby="order-heading" class="w-full mt-10 border-t border-gray-200">
            <div class="justify-center flex space-x-6 border-b border-gray-200 py-10">
                <section aria-labelledby="recent-heading">
                    <h2 id="recent-heading" class="sr-only">Recent orders</h2>
                    <div class="mx-auto sm:px-2 lg:px-8">
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
                                                            <dd class="order-first text-2xl font-semibold tracking-tight text-white flex justify-center">
                                                                <svg class="size-8" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
                                                                    <g>
                                                                        <rect fill="none" height="24" width="24">
                                                                        </rect>
                                                                    </g>
                                                                    <g>
                                                                        <rect height="2" opacity=".3" width="14" x="5" y="6"></rect>
                                                                        <path d="M19,4h-1V2h-2v2H8V2H6v2H5C3.89,4,3.01,4.9,3.01,6L3,20c0,1.1,0.89,2,2,2h14c1.1,0,2-0.9,2-2V6C21,4.9,20.1,4,19,4z M19,20 H5V10h14V20z M19,8H5V6h14V8z M9,14H7v-2h2V14z M13,14h-2v-2h2V14z M17,14h-2v-2h2V14z M9,18H7v-2h2V18z M13,18h-2v-2h2V18z M17,18 h-2v-2h2V18z">
                                                                        </path>
                                                                    </g>
                                                                </svg>
                                                            </dd>
                                                        </div>
                                                        <div class="flex flex-col bg-A1-500 p-2">
                                                            <dt class="text-sm/6 font-semibold text-white">
                                                                {{ $appointment->start_at->format('H:i') }}
                                                            </dt>
                                                            <dd class="order-first text-2xl font-semibold tracking-tight text-white flex justify-center">
                                                                <svg class="size-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                    <g fill="none" stroke="currentColor" stroke-width="1.2">
                                                                        <circle cx="12" cy="12" r="8.6" fill="currentColor" fill-opacity=".25"></circle>
                                                                        <path stroke-linecap="round" d="M16.5 12h-4.25a.25.25 0 0 1-.25-.25V8.5"></path>
                                                                    </g>
                                                                </svg>
                                                            </dd>
                                                        </div>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="mt-6 sm:flex sm:justify-end">
                                            <div
                                                class="mt-6 flex items-center divide-x divide-gray-200 border-t border-gray-200 pt-4 text-sm font-medium sm:mt-0 sm:ml-4 sm:border-none sm:pt-0">
                                                <div class="flex flex-1 justify-center pl-4">
                                                    <button 
                                                        type="button"
                                                        x-on:click="openCancel = true"
                                                        class="whitespace-nowrap text-gray-600 hover:text-gray-500 rounded border-gray-600 border px-2 py-1">
                                                        Cancelar agenda
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="mt-4 text-sm text-gray-500">
                                Si tienes alguna duda o problema, por favor no dudes en <a href="{{ route('contact') }}" class="text-A2-600 hover:underline">contactarnos</a>.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <div
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
                        wire:click="cancel" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                        Cancelar reserva
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
</div>
