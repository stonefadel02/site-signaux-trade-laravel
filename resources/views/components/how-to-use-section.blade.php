{{-- resources/views/components/how-to-use-section.blade.php --}}

@php
$steps = [
    [
        'name' => 'Inscription',
        'description' => 'Inscrivez-vous en quelques secondes.',
        'lucide_icon' => 'user-plus', // Nom de l'icône Lucide
        'isHighlighted' => false,
    ],
    [
        'name' => 'Abonnement',
        'description' => '',
        'image_src' => 'Layer 2.png', // Chemin vers l'image personnalisée
        'isHighlighted' => true,
    ],
    [
        'name' => 'Paiement',
        'description' => 'Effectuez votre paiement sécurisé (USDT / BTC).',
        'lucide_icon' => 'credit-card',
        'isHighlighted' => false,
    ],
    [
        'name' => 'Code d\'accès',
        'description' => 'Recevez votre code d\'accès et consultez les signaux de trading en temps réel.',
        'lucide_icon' => 'key-round',
        'isHighlighted' => false,
    ],
];
@endphp

<section class="bg-[#12141D] py-10 sm:py-10">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-[40px]">
                Comment Utiliser Les Signaux de Trading ?
            </h2>
            <p class="mt-4 text-lg leading-8 text-[23px] text-gray-300">
                Notre système est conçu pour être simple et efficace :
            </p>
        </div>

        <div class="relative mt-20">
            <div
                class="absolute left-0 top-[4.5rem] hidden w-full border-t border-dashed border-[#00AFFF] md:block"
                aria-hidden="true"
            ></div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-16 md:grid-cols-4">
                @foreach ($steps as $step)
                    <div class="flex h-full flex-col items-center text-center">
                        {{-- Bouton avec le nom de l'étape --}}
                        <div class="rounded-[50px] bg-[#0192EB] px-6 py-2 text-[18px] font-semibold text-white">
                            {{ $step['name'] }}
                        </div>

                        {{-- Point sur la ligne --}}
                        <div class="relative mt-4 h-12 w-full">
                            <div class="absolute left-1/2 top-1/2 hidden h-4 w-4 -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#00AFFF] md:block" aria-hidden="true"></div>
                        </div>

                        {{-- Carte de description --}}
                        <div
                            class="relative mt-10 flex h-full w-full flex-col items-center justify-center rounded-lg p-6 {{ $step['isHighlighted'] ? 'bg-[#00AFFF] text-white' : 'bg-[#1E273D] text-white' }}"
                        >
                            <div
                                class="absolute bottom-full left-1/2 -translate-x-1/2 w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent {{ $step['isHighlighted'] ? 'border-b-8 border-b-[#00AFFF]' : 'border-b-8 border-b-[#1E2027]' }}"
                                aria-hidden="true"
                            ></div>
                            
                            {{-- Affichage conditionnel de l'icône ou de l'image --}}
                            @if(isset($step['image_src']))
                                <img
                                    src="{{ asset($step['image_src']) }}"
                                    alt="{{ $step['name'] }}"
                                    class="mx-auto my-3 h-20 w-20"
                                    aria-hidden="true"
                                >
                            @elseif(isset($step['lucide_icon']))
                                @php
                                    // Construit dynamiquement le nom du composant icône
                                    $iconComponent = 'lucide-' . $step['lucide_icon'];
                                @endphp
                            @endif

                            <p class="mt-4 text-[15px] {{ $step['isHighlighted'] ? 'text-white' : 'text-white' }}">
                                {{ $step['description'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>