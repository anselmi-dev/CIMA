<x-container.page>
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
                            <div class="flex-1 py-10 border-t border-gray-200">
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

                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 bg-white">
                        <div class="text-center">
                            <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div class="mt-4 flex text-sm/6 text-gray-600 ">
                                <label for="file-upload"
                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-A1-600 focus-within:ring-2 focus-within:ring-A1-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-A1-500">
                                    <span>Sube un archivo</span>
                                    <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">o arrastra y suelta</p>
                            </div>
                            <p class="text-xs/5 text-gray-600">PNG, JPG, PDF hasta 10MB</p>
                        </div>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="about" class="block text-sm/6 font-medium text-gray-900 lg:px-2">Nota o observación</label>
                    <div class="mt-2">
                      <textarea placeholder="Escribe una nota o observación si es necesario."  name="about" id="about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                    </div>
                </div>

                <div class="col-span-full">
                    <div class="flex items-center gap-x-3 lg:px-2">
                        <input id="push-everything" name="push-notifications" type="radio" checked="" class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-A1-600 checked:bg-A1-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-A1-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                        <label for="push-everything" class="block text-sm/6 font-medium text-gray-900">
                            Acepto los términos y condiciones
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancelar reserva</button>
                    <button type="submit" class="rounded-md bg-A1-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-A1-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-A1-600">Enviar comprobante</button>
                </div>
            </div>
            <div class="text-center">
                <p class="mt-4 text-sm text-gray-500">
                    Si tienes alguna duda o problema, por favor no dudes en <a href="{{ route('contact') }}"
                        class="text-indigo-600 hover:underline">contactarnos</a>.
                </p>
            </div>
        </div>
    </section>
</x-container.page>
