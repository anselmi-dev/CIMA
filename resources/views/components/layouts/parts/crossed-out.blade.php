@props(['color' => 'text-A1-300'])

<span class="px-2 py-1 relative inline-block">
    <svg class="stroke-current bottom-0 absolute {{ $color }} -translate-x-2"
        viewBox="0 0 410 18" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 6.4c16.8 16.8 380.8-11.2 397.6 5.602" stroke-width="12" fill="none" fill-rule="evenodd"
            stroke-linecap="round"></path>
    </svg>
    <span class="relative">
        {{ $slot }}
    </span>
</span>
