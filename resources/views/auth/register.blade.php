<x-guest-layout>
    <x-authentication-card image="{{ asset('images/auth/bg-register.jpg') }}">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-slot name="head">
            <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">
                {{ __("Create Your Account") }}
            </h2>
            <p class="mt-2 text-sm leading-6 text-gray-500">
                {{ __("Join our community and start enjoying exclusive benefits. It only takes a few minutes to get started!") }}
            </p>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="rut" value="{{ __('RUT') }}" />
                <x-input id="rut"
                    class="block mt-1 w-full"
                    type="text"
                    name="rut"
                    :value="old('rut')"
                    required
                    aria-placeholder="{{ __('RUT') }}"
                    placeholder="{{ __('RUT') }}"
                    icon="identification"
                    autocomplete="rut" />
            </div>

            <div class="grid md:grid-cols-2 space-y-6 md:space-x-6 md:space-y-0">
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name"
                        class="block mt-1 w-full"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        aria-placeholder="{{ __('Name') }}"
                        placeholder="{{ __('Name') }}"
                        autofocus autocomplete="name" />
                </div>
    
                <div>
                    <x-label for="lastname" value="{{ __('Lastname') }}" />
                    <x-input id="lastname"
                        class="block mt-1 w-full"
                        type="text"
                        name="lastname"
                        :value="old('lastname')"
                        required
                        aria-placeholder="{{ __('Lastname') }}"
                        placeholder="{{ __('Lastname') }}"
                        autocomplete="lastname" />
                </div>
            </div>

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    aria-placeholder="{{ __('Email') }}"
                    icon="at-symbol"
                    placeholder="{{ __('Email') }}"
                    autocomplete="username" />
            </div>

            <div>
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input
                    id="phone"
                    class="block mt-1 w-full"
                    type="text"
                    name="phone"
                    :value="old('phone')"
                    required
                    aria-placeholder="{{ __('Phone') }}"
                    placeholder="{{ __('Phone') }}"
                    icon="phone"
                    autocomplete="phone" />
            </div>

            <div>
                <x-label for="studies" value="{{ __('Password') }}" />
                <x-input id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                    icon="lock-closed"
                    aria-placeholder="{{ __('Password') }}"
                    placeholder="{{ __('Password') }}"
                    autocomplete="new-password" />
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input
                    id="password_confirmation"
                    class="block mt-1 w-full"
                    type="password"
                    icon="lock-closed"
                    aria-placeholder="{{ __('Confirm Password') }}"
                    placeholder="{{ __('Confirm Password') }}"
                    name="password_confirmation"
                    required
                    autocomplete="new-password" />
            </div>

            @if(Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div>
                <x-filament::button type="submit" primary class="w-full">
                    {{ __('Register') }}
                </x-filament::button>
            </div>
        </form>


        <div class="mt-3">
            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm font-medium leading-6">
                    <span
                        class="bg-white px-6 text-gray-900">{{ __('Already registered?') }}</span>
                </div>
            </div>

            <div class="mt-3 grid grid-cols-1 gap-4 text-center">
                <div>
                    <x-filament::button href="{{ route('login') }}" flat primary>
                        {{ __('Sign In') }}
                    </x-filament::button>
                </div>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
