{{-- resources/views/components/signal-types-section.blade.php --}}

@php
$signalTypes = [
    [
        'line1' => 'Signaux de',
        'line2' => 'trading Forex',
        'textColor' => 'text-[#00AFFF]',
        'hoverRingColor' => 'hover:ring-[#00AFFF]',
    ],
    [
        'line1' => 'Signaux de',
        'line2' => 'trading crypto',
        'textColor' => 'text-[#00FD81]',
        'hoverRingColor' => 'hover:ring-[#00FD81]',
    ],
    [
        'line1' => 'Signaux de',
        'line2' => 'trading bourse',
        'textColor' => 'text-[#FB5044]',
        'hoverRingColor' => 'hover:ring-[#FB5044]',
    ],
    [
        'line1' => 'Signaux de',
        'line2' => 'trading OTC',
        'textColor' => 'text-[#00AFFF]',
        'hoverRingColor' => 'hover:ring-[#00AFFF]',
    ],
    [
        'line1' => 'Signaux de',
        'line2' => 'MetaTrader 4',
        'textColor' => 'text-[#FFC100]',
        'hoverRingColor' => 'hover:ring-[#FFC100]',
    ],
    [
        'line1' => 'Signaux de',
        'line2' => 'trading en ligne',
        'textColor' => 'text-[#FF4B05]',
        'hoverRingColor' => 'hover:ring-[#FF4B05]',
    ],
];
@endphp

<section class="bg-[#12141D] py-20 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        {{-- Conteneur principal avec fond en dégradé et coins arrondis --}}
        <div class="rounded-3xl bg-[#0D192F] p-8 sm:p-10 lg:p-16">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2 lg:gap-10">
                {{-- Colonne de gauche : Titre et grille des types de signaux --}}
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Quels Types de Signaux de Trading Propose-t-on ?
                    </h2>

                    {{-- Grille des "pilules" --}}
                    <div class="mt-10 grid grid-cols-2 gap-4 text-left sm:w-[350px]">
                        @foreach ($signalTypes as $type)
                            <div
                                class="cursor-pointer rounded-[10px] bg-[#1E273D] p-5 max-w-sm text-left text-white ring-1 ring-white/10 transition-all hover:bg-white/10 {{ $type['hoverRingColor'] }}"
                            >
                                <span class="block font-semibold">
                                    <span class="{{ $type['textColor'] }}">{{ $type['line1'] }}</span>
                                    <br />
                                    {{ $type['line2'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Colonne de droite : Image du laptop --}}
                <div class="flex justify-center">
                    <img
                        src="{{ asset('laptop2.png') }}"
                        alt="Graphique de trading sur un laptop"
                        class="w-full max-w-lg"
                    />
                </div>
            </div>
        </div>
    </div>
</section>