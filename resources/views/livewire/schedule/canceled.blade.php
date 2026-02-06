<x-container.page>
    <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
        <div class="mx-auto max-w-2xl px-4 lg:max-w-4xl lg:px-0">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                Reserva cancelada de {{ $appointment->medicalSpecialty->name }}
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                La cita con el profesional <strong>{{ $appointment->professional->full_name }}</strong> estaba programada para el <strong>{{ $appointment->start_at->format('d/m/Y') }}</strong> a las <strong>{{ $appointment->start_at->format('H:i') }}</strong>. La reserva ha sido cancelada.
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
                    <ul role="list" class="divide-y divide-gray-200" style="filter: grayscale(100%)">
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
                        </li>
                    </ul>
                </div>
            </div>
            <div class="text-center">
                <p class="mt-4 text-sm text-gray-500">
                    Si tienes alguna duda o problema, por favor no dudes en <a href="{{ route('contact') }}" class="text-indigo-600 hover:underline">contactarnos</a>.
                </p>
            </div>
        </div>
    </section>
</x-container.page>
