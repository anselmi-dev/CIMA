<!-- Footer -->
<div class="mx-auto mt-32 max-w-7xl px-6 lg:px-8">
    <footer aria-labelledby="footer-heading" class="relative border-t border-gray-900/10 py-24 sm:mt-56 sm:py-32">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <img class="h-7" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Company name">
            <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold leading-6 text-gray-900">
                            {{ __('Soporte') }}
                        </h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="{{ route('support') }}"
                                    class="text-sm leading-6 text-gray-600 hover:text-gray-900">
                                    {{ __('Soporte') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}"
                                    class="text-sm leading-6 text-gray-600 hover:text-gray-900">
                                    {{ __('Contacto') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('faqs') }}"
                                    class="text-sm leading-6 text-gray-600 hover:text-gray-900">
                                    {{ __('FAQs') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold leading-6 text-gray-900">
                            {{ __('Legal') }}
                        </h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="{{ route('privacy-policy') }}"
                                    class="text-sm leading-6 text-gray-600 hover:text-gray-900">
                                    {{ __('Política de privacidad') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('terms-and-conditions') }}"
                                    class="text-sm leading-6 text-gray-600 hover:text-gray-900">
                                    {{ __('Términos y condiciones') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cokies-policy') }}"
                                    class="text-sm leading-6 text-gray-600 hover:text-gray-900">
                                    {{ __('Política de cookies') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
