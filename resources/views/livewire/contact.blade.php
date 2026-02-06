<x-container.page>
    <div class="mx-auto max-w-xl lg:max-w-4xl">
        <h2 class="text-4xl font-bold tracking-tight text-gray-900">Contáctanos</h2>
        <p class="mt-2 text-lg leading-8 text-gray-600">
            Estamos aquí para ayudarte
        </p>
        <div class="mt-16 flex flex-col gap-10  sm:gap-y-20 lg:flex-row">
            <form wire:submit="submit" class="lg:flex-auto">
                @if (session('contact.success'))
                    <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-800 ring-1 ring-green-200">
                        {{ session('contact.success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">
                            {{ __('Nombre') }}
                        </label>
                        <div class="mt-2.5">
                            <input type="text" wire:model="name" id="name" autocomplete="given-name"
                                placeholder="Ej: Juan"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 {{ $errors->has('name') ? 'ring-red-500 focus:ring-red-600' : 'ring-gray-300 focus:ring-indigo-600' }}">
                        </div>
                        @error('name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-semibold leading-6 text-gray-900">
                            {{ __('Apellido') }}
                        </label>
                        <div class="mt-2.5">
                            <input type="text" wire:model="last_name" id="last_name" autocomplete="family-name"
                                placeholder="Ej: Pérez"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 {{ $errors->has('last_name') ? 'ring-red-500 focus:ring-red-600' : 'ring-gray-300 focus:ring-indigo-600' }}">
                        </div>
                        @error('last_name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-full">
                        <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">
                            {{ __('Email') }}
                        </label>
                        <div class="mt-2.5">
                            <input type="email" wire:model="email" id="email" autocomplete="email"
                                placeholder="Ej: ejemplo@correo.com"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 {{ $errors->has('email') ? 'ring-red-500 focus:ring-red-600' : 'ring-gray-300 focus:ring-indigo-600' }}">
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">
                            {{ __('Mensaje') }}
                        </label>
                        <div class="mt-2.5">
                            <textarea wire:model="message" id="message" rows="4"
                                placeholder="Ej: Hola, necesito ayuda con..."
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 {{ $errors->has('message') ? 'ring-red-500 focus:ring-red-600' : 'ring-gray-300 focus:ring-indigo-600' }}"></textarea>
                        </div>
                        @error('message')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-10">
                    <button type="submit" wire:loading.attr="disabled"
                        class="block w-full rounded-md bg-A1-default px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-A1-hover focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:opacity-70">
                        <span wire:loading.remove wire:target="submit">{{ __('Enviar') }}</span>
                        <span wire:loading wire:target="submit">{{ __('Enviando...') }}</span>
                    </button>
                </div>
                <p class="mt-4 text-sm leading-6 text-gray-500">
                    Al enviar este formulario, acepto la <a href="{{ route('privacy-policy') }}" class="font-semibold text-A1-default">política de privacidad</a>.
                </p>
            </form>

            <div class="lg:w-1/2 lg:flex-none">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        En CIMA, tu experiencia es nuestra prioridad. Si tienes alguna pregunta, inquietud, o
                        necesitas asistencia, no dudes en ponerte en contacto con nosotros. Estamos disponibles para
                        ayudarte en todo lo que necesites.
                    </p>
                </div>
                {{-- <div
                    class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 text-base leading-7 sm:grid-cols-2 sm:gap-y-16 lg:mx-0 lg:max-w-none">
                    <div>
                        <h3 class="border-l border-A1-default pl-6 font-semibold text-gray-900">Los Angeles</h3>
                        <address class="border-l border-gray-200 pl-6 pt-2 not-italic text-gray-600">
                            <p>4556 Brendan Ferry</p>
                            <p>Los Angeles, CA 90210</p>
                        </address>
                    </div>
                    <div>
                        <h3 class="border-l border-A1-default pl-6 font-semibold text-gray-900">New York</h3>
                        <address class="border-l border-gray-200 pl-6 pt-2 not-italic text-gray-600">
                            <p>886 Walter Street</p>
                            <p>New York, NY 12345</p>
                        </address>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</x-container.page>
