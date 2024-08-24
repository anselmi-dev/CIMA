<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="rut" value="{{ __('RUT') }}" />
                <x-input id="rut" class="block mt-1 w-full" type="text" name="rut" :value="old('rut')" required
                    autocomplete="rut" />
            </div>

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div>
                <x-label for="lastname" value="{{ __('Lastname') }}" />
                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required
                    autocomplete="lastname" />
            </div>

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autocomplete="username" />
            </div>

            <div>
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                    autocomplete="phone" />
            </div>

            <div>
                <x-label for="university" value="{{ __('Universidad') }}" />
                <x-input id="university" class="block mt-1 w-full" type="text" name="university" :value="old('university')" required
                    autocomplete="university" />
            </div>

            <div>
                <x-label for="studies" value="{{ __('Universidad') }}" />
                <x-input id="studies" class="block mt-1 w-full" type="text" name="studies" :value="old('studies')" required
                    autocomplete="studies" />
            </div>

            <div>
                <x-label for="studies" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
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
                <x-wireui-button type="submit" primary class="w-full">
                    {{ __('Register') }}
                </x-wireui-button>
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
                    <x-wireui-button href="{{ route('login') }}" flat primary>
                        {{ __('Sign In') }}
                    </x-wireui-button>
                </div>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
