<div class="mt-10 text-center">
    <div class="flex items-center justify-center text-gray-900">
        <button wire:click="prevMonth"
            class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
            <span class="sr-only">Previous month</span>
            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <div class="flex-auto text-sm font-semibold">
            {{ \Carbon\Carbon::create($currentYear, $currentMonth)->format('F Y') }}
        </div>
        <button wire:click="nextMonth"
            class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
            <span class="sr-only">Next month</span>
            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>

    <div class="mt-6 grid grid-cols-7 text-xs text-gray-500">
        <div>M</div>
        <div>T</div>
        <div>W</div>
        <div>T</div>
        <div>F</div>
        <div>S</div>
        <div>S</div>
    </div>

    <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm ring-1 shadow-sm ring-gray-200">
        @foreach($dates as $day)
            <button type="button"
                class="py-1.5 hover:bg-gray-100 focus:z-10
                {{ $day['currentMonth'] ? 'bg-white text-gray-900' : 'bg-gray-50 text-gray-400' }}
                {{ $day['date']->isToday() ? 'text-indigo-600 font-semibold' : '' }}">
                <time datetime="{{ $day['date']->toDateString() }}"
                    class="mx-auto flex size-7 items-center justify-center rounded-full">
                    {{ $day['date']->day }}
                </time>
            </button>
        @endforeach
    </div>
</div>
