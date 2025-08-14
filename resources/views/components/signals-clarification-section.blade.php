{{-- resources/views/components/signals-clarification-section.blade.php --}}

{{-- On définit les données directement dans la vue pour plus de simplicité --}}
@php
$signalFeatures = [
    ['name' => 'La paire', 'icon_src' => 'i1.png'],
    ['name' => 'La Direction', 'icon_src' => 'i2.png'],
    ['name' => 'Timeframe', 'icon_src' => 'i3.png'],
    ['name' => 'StopLoss', 'icon_src' => 'i4.png'],
    ['name' => '% Succès', 'icon_src' => 'i5.png'],
];
@endphp

<section class="bg-[#12141D] py-20 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        {{-- Conteneur principal avec fond en dégradé et coins arrondis --}}
        <div class="rounded-3xl bg-gradient-to-br from-[#1E2028] to-[#022E8F] p-8 sm:p-10 lg:p-16">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2 lg:gap-8">
                {{-- Colonne de gauche : Image du téléphone --}}
                <div class="flex justify-center">
                    <img
                        src="{{ asset('smartphone.png') }}"
                        alt="Signaux de trading sur un téléphone"
                        class="w-auto max-w-xs"
                    />
                </div>

                {{-- Colonne de droite : Contenu texte et icônes --}}
                <div class="mx-10 text-center lg:text-left">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-[40px]">
                        Nos signaux de trading sont clairement définis
                    </h2>
                    <p class="mx-2 mt-4 text-lg leading-8 text-gray-300">
                        Nos signaux de trading sont conçus pour maximiser vos profits
                        tout en minimisant les risques.
                    </p>

                    {{-- Grille des fonctionnalités --}}
                    <div class="mt-10 grid grid-cols-2 gap-8 sm:grid-cols-3 lg:grid-cols-3">
                        @foreach ($signalFeatures as $feature)
                            <div class="flex flex-col items-center gap-4 text-center">
                                <div class="flex h-24 w-24 items-center justify-center rounded-full bg-white">
                                    <img 
                                        src="{{ asset($feature['icon_src']) }}" 
                                        alt="{{ $feature['name'] }}"
                                    >
                                </div>
                                <span class="font-semibold text-white">
                                    {{ $feature['name'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>