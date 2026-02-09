<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-base/7 font-semibold text-indigo-600">{{ __('Testimonios') }}</h2>
            <p class="mt-2 text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                {{ __('Lo que dicen quienes nos eligen') }}
            </p>
        </div>
        <div class="mx-auto mt-16 flow-root max-w-2xl sm:mt-20 lg:mx-0 lg:max-w-none">
            @if ($testimonials->isNotEmpty())
                <div class="-mt-8 sm:-mx-4 sm:columns-2 sm:text-[0] lg:columns-3">
                    @foreach ($testimonials as $testimonial)
                        <div class="pt-8 sm:inline-block sm:w-full sm:px-4">
                            <figure class="rounded-2xl bg-gray-100 p-8 text-sm/6">
                                <blockquote class="text-gray-900">
                                    <p>"{{ $testimonial->content }}"</p>
                                </blockquote>
                                <figcaption class="mt-6 flex items-center gap-x-4">
                                    <img src="{{ asset('images/user-test.png') }}" alt="" class="size-10 rounded-full bg-gray-50 object-cover" />
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $testimonial->name }}</div>
                                        {{-- <div class="text-gray-600">{{ $testimonial->role ?? '—' }}</div> --}}
                                        @if ($testimonial->rating)
                                            <div class="text-sm flex items-center gap-x-1 text-amber-500 mt-0.5">
                                                @foreach (range(1, $testimonial->rating) as $star)
                                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 flex-none">
                                                        <path d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                                  </svg>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mt-12 text-center text-gray-500">
                    {{ __('No hay testimonios disponibles') }}
                </div>
            @endif
        </div>
    </div>
</div>
