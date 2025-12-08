<x-guest-layout>
    <x-authentication-card>
        <x-slot name="head">
            <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">
                {{ __('Sign in to your account') }}
            </h2>
            <p class="mt-2 text-sm leading-6 text-gray-500">
                {{ __('Not a member?') }}
                <a href="{{ route('register') }}" class="font-semibold text-A1-default hover:text-A1-hover">
                    {{ __('Sign up with us') }}
                </a>
            </p>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <div class="mt-2">
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    aria-placeholder="{{ __('Email') }}"
                    icon="at-symbol"
                    placeholder="{{ __('Email') }}"
                        required autofocus autocomplete="username" />
                </div>
            </div>

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="mt-2">
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        icon="lock-closed"
                        aria-placeholder="{{ __('Password') }}"
                        placeholder="{{ __('Password') }}"
                        autocomplete="current-password" />
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span
                            class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                @if(Route::has('password.request'))
                    <div class="text-sm leading-6">
                        <a class="underline text-sm text-A1-default dark:text-gray-400 hover:text-A1-hover dark:hover:text-A1-hover rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-text-A1-hover dark:focus:ring-offset-A1-hover"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </div>

            <div>
                <x-filament::button type="submit" primary class="w-full">
                    {{ __('Sign In') }}
                </x-filament::button>
            </div>
        </form>

        <div class="mt-3">
            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm font-medium leading-6">
                    <span class="bg-white px-6 text-gray-900">{{ __('Or') }}</span>
                </div>
            </div>

            <div class="mt-3 grid grid-cols-1 gap-4 text-center">
                <div>
                    <x-filament::button href="{{ route('register') }}" flat primary>
                        {{ __('Register') }}
                    </x-filament::button>
                </div>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
