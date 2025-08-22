{{-- resources/views/signals/public-show.blade.php --}}
@section('pageTitle', __('signals.show_title'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('signals.detail_header') }}{{ $signal->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-8 shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <p class="text-sm text-gray-500">{{ __('signals.pair_asset') }}</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $signal->actif->Nom ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">{{ __('signals.table.direction') }}</p>
                        <p
                            class="text-lg font-semibold {{ $signal->Direction === 'BUY' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $signal->Direction === 'BUY' ? __('signals.buy') . ' (Haut)' : __('signals.sell') . ' (Bas)' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">{{ __('signals.table.date') }}</p>
                        <p class="text-lg text-gray-800">
                            {{ \Carbon\Carbon::parse($signal->DateHeureEmission)->format('d/m/Y à H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">{{ __('signals.duration') }}</p>
                        <p class="text-lg text-gray-800">{{ $signal->DureeTrade }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">{{ __('signals.entry_price') }}</p>
                        <p class="text-lg text-gray-800">{{ $signal->PrixEntree }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">{{ __('signals.confidence') }}</p>
                        <p class="text-lg text-gray-800">{{ $signal->Confiance ?? 'N/A' }} %</p>
                    </div>
                    <div class="text-green-600">
                        <p class="text-sm text-gray-500">{{ __('signals.take_profit_tp') }}</p>
                        <p class="text-lg font-semibold">{{ $signal->TakeProfit ?? 'N/A' }}</p>
                    </div>
                    <div class="text-red-600">
                        <p class="text-sm text-gray-500">{{ __('signals.stop_loss_sl') }}</p>
                        <p class="text-lg font-semibold">{{ $signal->StopLoss ?? 'N/A' }}</p>
                    </div>
                </div>

                @if ($signal->Commentaire)
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <p class="text-sm text-gray-500">{{ __('signals.analyst_comment') }}</p>
                        <p class="mt-2 text-base text-gray-700">{{ $signal->Commentaire }}</p>
                    </div>
                @endif

                <div class="mt-8 flex items-center gap-4 border-t border-gray-200 pt-6">
                    <a href="{{ route('signaux') }}"
                        class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                        {{ __('signals.back_to_signals') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
