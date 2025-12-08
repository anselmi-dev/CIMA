@props([
    'head' => '',
    'image' => 'https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80'
])

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

        <div class="relative hidden w-0 flex-1 lg:block overflow-hidden">
            <div class="absolute top-0 left-0 bg-A1-default/50 w-full h-full z-1"></div>
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ $image }}">
            <svg viewBox="0 0 926 676" aria-hidden="true" class="absolute -bottom-24 left-24 w-[57.875rem] transform-gpu blur-[118px]">
                <path fill="url(#60c3c621-93e0-4a09-a0e6-4c228a0116d8)" fill-opacity=".4" d="m254.325 516.708-90.89 158.331L0 436.427l254.325 80.281 163.691-285.15c1.048 131.759 36.144 345.144 168.149 144.613C751.171 125.508 707.17-93.823 826.603 41.15c95.546 107.978 104.766 294.048 97.432 373.585L685.481 297.694l16.974 360.474-448.13-141.46Z"></path>
                <defs>
                  <linearGradient id="60c3c621-93e0-4a09-a0e6-4c228a0116d8" x1="926.392" x2="-109.635" y1=".176" y2="321.024" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#776FFF"></stop>
                    <stop offset="1" stop-color="#FF4694"></stop>
                  </linearGradient>
                </defs>
            </svg>
        </div>
    </div>
