@if($page)
    <x-legal-page :title="$page->name ?? __('Términos y condiciones')" :content="$page->content" />
@else
    <x-container.page :title="__('Términos y condiciones')">
        <div class="mx-auto max-w-4xl">
            <p class="text-lg leading-8 text-gray-600">
                {{ __('Esta página está en construcción. Por favor, contacta al administrador.') }}
            </p>
        </div>
    </x-container.page>
@endif
