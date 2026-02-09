@php
    $transaction = $this->getTransaction();
@endphp

@if($transaction)
    <x-filament-widgets::widget>
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-filament::icon
                        icon="heroicon-o-banknotes"
                        class="h-5 w-5"
                    />
                    {{ __('Información de Transferencia') }}
                </div>
            </x-slot>

            <div class="space-y-4">
                @if($transaction->getFirstMediaUrl())
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Documento Adjunto') }}
                        </label>
                        <div class="mt-1">
                            <a 
                                href="{{ $transaction->getFirstMediaUrl() }}" 
                                target="_blank"
                                class="inline-flex items-center gap-2 text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300"
                            >
                                <x-filament::icon
                                    icon="heroicon-o-document-arrow-down"
                                    class="h-4 w-4"
                                />
                                {{ __('Ver documento') }}
                            </a>
                        </div>
                    </div>
                @endif

                @if($transaction->notes)
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Nota') }}
                        </label>
                        <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ $transaction->notes }}
                        </div>
                    </div>
                @endif

                <div class="text-xs text-gray-500 dark:text-gray-400">
                    {{ __('Fecha de pago') }}: {{ $transaction->payment_date->format('d/m/Y') }}
                </div>
            </div>
        </x-filament::section>
    </x-filament-widgets::widget>
@endif
