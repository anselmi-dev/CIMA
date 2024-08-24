@props(['head' => ''])

    <div class="flex min-h-full">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <x-authentication-card-logo />

                    {{ $head }}
                </div>

                <div class="mt-10">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <div class="relative hidden w-0 flex-1 lg:block">
            @if(isset($image))
                {{ $image }}
            @else
                <img class="absolute inset-0 h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80">
            @endif
        </div>
    </div>
