<x-container.page>
    <div class="mt-6 | grid lg:grid-cols-3 gap-6">
        <div class="md:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 space-y-6">
            <div class="flex space-x-2 text-gray-500">
                <div class="flex-none">
                    <img src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=8&amp;w=256&amp;h=256&amp;q=80"
                        alt="" class="h-10 w-10 min-w-20 min-h-20 rounded-full bg-gray-100">
                </div>
                <div class="flex-1">
                    <h1 class="font-medium text-gray-900 text-4xl">
                        {{ $professional->full_name }}
                    </h1>
                    <p class="text-lg">
                        {{ $professional->medical_specialty }}
                    </p>
                </div>
            </div>
            
            <div>
                <div class="space-y-6">
                    <p class="text-base text-gray-900">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus modi libero nostrum quos, nulla quis adipisci vel illum nisi omnis autem quaerat molestiae asperiores deleniti perspiciatis tempore, id sed repudiandae?
                    </p>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-900">
                    lorem
                </h3>

                <div class="mt-4">
                    <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                        <li class="text-gray-400"><span class="text-gray-600">Lorem ipsum dolor sit amet.</span></li>
                        <li class="text-gray-400"><span class="text-gray-600">Lorem, ipsum dolor.</span></li>
                        <li class="text-gray-400"><span class="text-gray-600">Lorem, ipsum.</span></li>
                        <li class="text-gray-400"><span class="text-gray-600">Lorem ipsum dolor sit.</span></li>
                    </ul>
                </div>
            </div>

            <section aria-labelledby="shipping-heading">
                <h2 id="shipping-heading" class="text-sm font-medium text-gray-900">Details</h2>

                <div class="mt-4 space-y-6">
                    <p class="text-sm text-gray-600">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus libero consectetur ea.
                    </p>
                </div>
            </section>
        </div>

        <div class="space-y-6">
            
            <div>
                <h2 class="text-xl">Precio de la consulta</h2>

                <p class="text-3xl tracking-tight text-gray-900">$192</p>
            </div>

            <form class="space-y-6">
                <!-- Days -->
                <div class="mt-10">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-900">Size</h3>
                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Size guide</a>
                    </div>

                    <fieldset aria-label="Choose a size" class="mt-4">
                        <div x-data="window.Components.radioGroup({ initialCheckedIndex: 2 })" x-init="init()"
                            class="grid grid-cols-4 gap-4 sm:grid-cols-7 lg:grid-cols-7">
                            <label x-radio-group-option=""
                                class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-not-allowed bg-gray-50 text-gray-200 undefined"
                                x-state:on:size.instock="In Stock" x-state:off:size.instock="Out of Stock"
                                x-description="Active: &quot;ring-2 ring-indigo-500&quot;"
                                :class="{ 'ring-2 ring-indigo-500': (active === 'XXS'), 'undefined': !(active === 'XXS') }">
                                <input type="radio" x-model="value" name="size-choice" value="XXS" disabled=""
                                    class="sr-only">
                                <span>LUN</span>
                                <span aria-hidden="true"
                                    class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200">
                                    <svg class="absolute inset-0 h-full w-full stroke-2 text-gray-200"
                                        viewBox="0 0 100 100" preserveAspectRatio="none" stroke="currentColor">
                                        <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke"></line>
                                    </svg>
                                </span>
                            </label>
                            <label x-radio-group-option=""
                                class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm undefined"
                                x-state:on:size.instock="In Stock" x-state:off:size.instock="Out of Stock"
                                x-description="Active: &quot;ring-2 ring-indigo-500&quot;"
                                :class="{ 'ring-2 ring-indigo-500': (active === 'XS'), 'undefined': !(active === 'XS') }">
                                <input type="radio" x-model="value" name="size-choice" value="XS" class="sr-only">
                                <span>MAR</span>
                                <span
                                    class="pointer-events-none absolute -inset-px rounded-md border-2 border-transparent"
                                    aria-hidden="true"
                                    x-description="Active: &quot;border&quot;, Not Active: &quot;border-2&quot;	Checked: &quot;border-indigo-500&quot;, Not Checked: &quot;border-transparent&quot;"
                                    :class="{ 'border': (active === 'XS'), 'border-2': !(active === 'XS'), 'border-indigo-500': (value === 'XS'), 'border-transparent': !(value === 'XS') }"></span>
                            </label>
                            <label x-radio-group-option=""
                                class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm undefined"
                                x-state:on:size.instock="In Stock" x-state:off:size.instock="Out of Stock"
                                x-description="Active: &quot;ring-2 ring-indigo-500&quot;"
                                :class="{ 'ring-2 ring-indigo-500': (active === 'S'), 'undefined': !(active === 'S') }">
                                <input type="radio" x-model="value" name="size-choice" value="S" class="sr-only">
                                <span>MIE</span>
                                <span
                                    class="pointer-events-none absolute -inset-px rounded-md border-2 border-indigo-500"
                                    aria-hidden="true"
                                    x-description="Active: &quot;border&quot;, Not Active: &quot;border-2&quot;	Checked: &quot;border-indigo-500&quot;, Not Checked: &quot;border-transparent&quot;"
                                    :class="{ 'border': (active === 'S'), 'border-2': !(active === 'S'), 'border-indigo-500': (value === 'S'), 'border-transparent': !(value === 'S') }"></span>
                            </label>
                            <label x-radio-group-option=""
                                class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm undefined"
                                x-state:on:size.instock="In Stock" x-state:off:size.instock="Out of Stock"
                                x-description="Active: &quot;ring-2 ring-indigo-500&quot;"
                                :class="{ 'ring-2 ring-indigo-500': (active === 'M'), 'undefined': !(active === 'M') }">
                                <input type="radio" x-model="value" name="size-choice" value="M" class="sr-only">
                                <span>JUE</span>
                                <span
                                    class="pointer-events-none absolute -inset-px rounded-md border-2 border-transparent"
                                    aria-hidden="true"
                                    x-description="Active: &quot;border&quot;, Not Active: &quot;border-2&quot;	Checked: &quot;border-indigo-500&quot;, Not Checked: &quot;border-transparent&quot;"
                                    :class="{ 'border': (active === 'M'), 'border-2': !(active === 'M'), 'border-indigo-500': (value === 'M'), 'border-transparent': !(value === 'M') }"></span>
                            </label>
                            <label x-radio-group-option=""
                                class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm undefined"
                                x-state:on:size.instock="In Stock" x-state:off:size.instock="Out of Stock"
                                x-description="Active: &quot;ring-2 ring-indigo-500&quot;"
                                :class="{ 'ring-2 ring-indigo-500': (active === 'L'), 'undefined': !(active === 'L') }">
                                <input type="radio" x-model="value" name="size-choice" value="L" class="sr-only">
                                <span>VIE</span>
                                <span
                                    class="pointer-events-none absolute -inset-px rounded-md border-2 border-transparent"
                                    aria-hidden="true"
                                    x-description="Active: &quot;border&quot;, Not Active: &quot;border-2&quot;	Checked: &quot;border-indigo-500&quot;, Not Checked: &quot;border-transparent&quot;"
                                    :class="{ 'border': (active === 'L'), 'border-2': !(active === 'L'), 'border-indigo-500': (value === 'L'), 'border-transparent': !(value === 'L') }"></span>
                            </label>
                            <label x-radio-group-option=""
                                class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm undefined"
                                x-state:on:size.instock="In Stock" x-state:off:size.instock="Out of Stock"
                                x-description="Active: &quot;ring-2 ring-indigo-500&quot;"
                                :class="{ 'ring-2 ring-indigo-500': (active === 'XL'), 'undefined': !(active === 'XL') }">
                                <input type="radio" x-model="value" name="size-choice" value="XL" class="sr-only">
                                <span>SAV</span>
                                <span
                                    class="pointer-events-none absolute -inset-px rounded-md border-2 border-transparent"
                                    aria-hidden="true"
                                    x-description="Active: &quot;border&quot;, Not Active: &quot;border-2&quot;	Checked: &quot;border-indigo-500&quot;, Not Checked: &quot;border-transparent&quot;"
                                    :class="{ 'border': (active === 'XL'), 'border-2': !(active === 'XL'), 'border-indigo-500': (value === 'XL'), 'border-transparent': !(value === 'XL') }"></span>
                            </label>
                            <label x-radio-group-option=""
                                class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm undefined"
                                x-state:on:size.instock="In Stock" x-state:off:size.instock="Out of Stock"
                                x-description="Active: &quot;ring-2 ring-indigo-500&quot;"
                                :class="{ 'ring-2 ring-indigo-500': (active === '2XL'), 'undefined': !(active === '2XL') }">
                                <input type="radio" x-model="value" name="size-choice" value="2XL" class="sr-only">
                                <span>DOM</span>
                                <span
                                    class="pointer-events-none absolute -inset-px rounded-md border-2 border-transparent"
                                    aria-hidden="true"
                                    x-description="Active: &quot;border&quot;, Not Active: &quot;border-2&quot;	Checked: &quot;border-indigo-500&quot;, Not Checked: &quot;border-transparent&quot;"
                                    :class="{ 'border': (active === '2XL'), 'border-2': !(active === '2XL'), 'border-indigo-500': (value === '2XL'), 'border-transparent': !(value === '2XL') }"></span>
                            </label>

                        </div>
                    </fieldset>
                </div>

                <x-filament::button type="submit" primary class="w-full">
                    {{ __('Agendar') }}
                </x-filament::button>
            </form>
        </div>
    </div>
</x-container.page>
