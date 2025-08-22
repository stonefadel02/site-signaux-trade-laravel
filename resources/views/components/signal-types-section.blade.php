{{-- resources/views/components/signal-types-section.blade.php --}}

@php
    $items = __('welcome.signal_types.items');
    // Map colors statically as before
    $colors = [
        ['text' => 'text-[#00AFFF]', 'ring' => 'hover:ring-[#00AFFF]'],
        ['text' => 'text-[#00FD81]', 'ring' => 'hover:ring-[#00FD81]'],
        ['text' => 'text-[#FB5044]', 'ring' => 'hover:ring-[#FB5044]'],
        ['text' => 'text-[#00AFFF]', 'ring' => 'hover:ring-[#00AFFF]'],
        ['text' => 'text-[#FFC100]', 'ring' => 'hover:ring-[#FFC100]'],
        ['text' => 'text-[#FF4B05]', 'ring' => 'hover:ring-[#FF4B05]'],
    ];
    $signalTypes = [];
    foreach ($items as $idx => $it) {
        $signalTypes[] = [
            'line1' => $it['line1'],
            'line2' => $it['line2'],
            'textColor' => $colors[$idx]['text'],
            'hoverRingColor' => $colors[$idx]['ring'],
        ];
    }
@endphp

<section class="bg-[#12141D] py-20 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        {{-- Conteneur principal avec fond en dégradé et coins arrondis --}}
        <div class="rounded-3xl bg-[#0D192F] p-8 sm:p-10 lg:p-16">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2 lg:gap-10">
                {{-- Colonne de gauche : Titre et grille des types de signaux --}}
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        {{ __('welcome.signal_types.title') }}
                    </h2>

                    {{-- Grille des "pilules" --}}
                    <div class="mt-10 grid grid-cols-2 gap-4 text-left sm:w-[350px]">
                        @foreach ($signalTypes as $type)
                            <div
                                class="cursor-pointer rounded-[10px] bg-[#1E273D] p-5 max-w-sm text-left text-white ring-1 ring-white/10 transition-all hover:bg-white/10 {{ $type['hoverRingColor'] }}">
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
                    <img src="{{ asset('laptop2.png') }}" alt="Graphique de trading sur un laptop"
                        class="w-full max-w-lg" />
                </div>
            </div>
        </div>
    </div>
</section>
