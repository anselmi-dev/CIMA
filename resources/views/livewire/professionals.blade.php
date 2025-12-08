<x-container.page :title="__('Profesionales')">
    <div class="mt-6 | grid xl:grid-cols-3 md:grid-cols-2 gap-6">
        @forelse ($professionals as $professional)
            <div>
                <div class="bg-white shadow rounded p-5">
                    <div class="flex items-start gap-6 ">
                        <img src="{{ asset('images/user-test.png') }}" alt="" class="rounded-xl h-32">
                        <div class="flex-1">
                            <p class="font-medium text-base text-gray-500">
                                {{ $professional->medical_specialty }}
                            </p>
                            <h2 class="text-xl mb-1">
                                {{ $professional->full_name }}
                            </h2>

                            <div>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            </div>

                            <div class="mt-2 flex items-center justify-end gap-2">
                                <x-filament::button href="{{ route('home') }}" xs primary>
                                    {{ __('Agendar cita') }}
                                </x-filament::button>
                                <x-filament::button href="{{ $professional->url_profile }}" xs primary outline>
                                    <span>{{ __('Ver perfil') }}</span>
                                </x-filament::button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            
        @endforelse
    </div>
</x-container.page>