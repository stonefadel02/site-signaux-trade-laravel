{{-- resources/views/signals/public-index.blade.php --}}
@section('pageTitle', __('signals.page_title_index'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('signals.header_index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if ($souscription)
                <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('signals.plan_signals_for') }}
                        {{ $souscription->plan->nom }}</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ __('signals.latest_intro') }}</p>

                    <div class="mt-6 overflow-x-auto rounded-lg border">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('signals.table.date') }}</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('signals.table.session') }}</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('signals.table.pair') }}</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('signals.table.direction') }}</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('signals.table.entry') }}</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('signals.table.take_profit') }}</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('signals.table.stop_loss') }}</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('signals.table.action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($signals as $signal)
                                    <tr>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($signal->DateHeureEmission)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            {{ $signal->session->Titre ?? 'N/A' }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $signal->actif->Nom ?? 'N/A' }}</td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm font-semibold {{ $signal->Direction === 'BUY' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $signal->Direction === 'BUY' ? __('signals.buy') : __('signals.sell') }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            {{ $signal->PrixEntree }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            {{ $signal->TakeProfit ?? 'N/A' }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            {{ $signal->StopLoss ?? 'N/A' }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                                            <button
                                                class="rounded-md bg-gray-800 px-4 py-1.5 text-white shadow-sm hover:bg-gray-700">
                                                <a href="{{ route('signals.public.show', $signal) }}">
                                                    {{ __('signals.go') }}
                                                </a>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                            {{ __('signals.none_available') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $signals->links() }}
                    </div>
                </div>
            @else
                <div class="rounded-lg bg-white p-8 text-center shadow-sm">
                    <i class="fa-solid fa-lock text-4xl text-gray-400"></i>
                    <h3 class="mt-4 text-lg font-semibold text-gray-800">{{ __('signals.restricted_access') }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ __('signals.need_subscription') }}</p>
                    <a href="{{-- route('plans.index') --}}"
                        class="mt-6 inline-block rounded-md bg-cyan-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-cyan-700">
                        {{ __('signals.see_plans') }}
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
