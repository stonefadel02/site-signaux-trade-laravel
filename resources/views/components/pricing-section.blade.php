{{-- resources/views/components/pricing-section.blade.php --}}

@php
$plans = [
    [
        'name' => 'Abonnement Journalier',
        'price' => '$15',
        'frequency' => '/jour',
        'priceSubtext' => '(0,5 $ par signal)',
        'features' => [
            '7 signaux par session',
            'Accès immédiat après paiement',
            'Code unique valable 24h',
        ],
        'buttonText' => 'CHOISIR',
        'isPopular' => false,
    ],
    [
        'name' => 'Abonnement Hebdomadaire',
        'price' => '$84',
        'frequency' => '/semaine',
        'priceSubtext' => '(Économisez 21 $ vs le tarif journalier)',
        'features' => [
            '147 signaux sur 7 jours (21 signaux/jour)',
            'Accès illimité pendant 7 jours',
            'Support prioritaire',
        ],
        'buttonText' => 'CHOISIR',
        'isPopular' => true,
    ],
    [
        'name' => 'Abonnement Mensuel',
        'price' => '$315',
        'frequency' => '/mois',
        'priceSubtext' => '(Économisez 135 $ vs le tarif journalier)',
        'features' => [
            '630 signaux sur 30 jours (21 signaux/jour)',
            'Accès illimité + historique des signaux',
            'Statistiques de performance incluses',
        ],
        'buttonText' => 'CHOISIR',
        'isPopular' => false,
    ],
];
@endphp

<section class="bg-[#12141D] py-10 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        {{-- Conteneur avec le fond #0D192F --}}
        <div class="rounded-3xl mx-auto bg-[#0D192F] p-8 sm:p-12 lg:p-16">
            <x-animated-div class="mx-auto max-w-4xl text-center">
                <h2 class="mx-auto text-center text-3xl font-bold tracking-tight text-white sm:text-[40px]">
                    Optez pour l’abonnement qui <br /> vous convient
                </h2>
                <p class="mt-4 sm:text-[23px] text-center leading-8 text-gray-300">
                    Profitez dès maintenant de nos signaux de trading fiables <br /> à
                    partir des prix imbattables de 0,5 dollar.
                </p>
            </x-animated-div>

            <div class="isolate mx-auto mt-16 grid max-w-md grid-cols-1 gap-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach ($plans as $index => $plan)
                    <x-animated-div
                        :delay="$index * 150"
                        class="flex flex-col"
                    >
                        <div
                            class="flex h-full flex-col rounded-[15px] bg-[#12141D] p-8 ring-1 {{ $plan['isPopular'] ? 'ring-2 ring-cyan-400' : 'ring-white/10' }}"
                        >
                            <h3 class="text-[20px] font-semibold leading-8 text-white">
                                {{ $plan['name'] }}
                            </h3>
                            <p class="mt-4 flex items-baseline gap-x-1">
                                <span class="text-[45px] font-bold tracking-tight text-white">
                                    {{ $plan['price'] }}
                                </span>
                                <span class="text-[20px] font-semibold leading-6 text-white">
                                    {{ $plan['frequency'] }}
                                </span>
                            </p>
                            <p class="mt-2 text-[15px] text-[#00AFFF]">
                                {{ $plan['priceSubtext'] }}
                            </p>

                            <hr class="my-3 border-[#00AFFF]" />

                            <ul role="list" class="mt-8 space-y-3 text-[16px] font-bold leading-6 text-white">
                                @foreach ($plan['features'] as $feature)
                                    <li class="flex gap-x-3">
                                        <img src="{{ asset('check.png') }}" alt="Checkmark" class="h-6 w-5">
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="flex-grow"></div>

                            <a
                                href="#"
                                class="mt-8 block w-1/2 rounded-[10px] border border-[#00AFFF] px-3 py-3 text-center text-sm leading-6 transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 {{ $plan['isPopular'] ? 'bg-[#00AFFF] text-[#12141D] shadow-sm hover:bg-cyan-300 focus-visible:outline-[#00AFFF]' : 'text-[#00AFFF] ring-1 ring-inset ring-white/20 hover:bg-white/10 focus-visible:outline-white' }}"
                            >
                                {{ $plan['buttonText'] }}
                            </a>
                        </div>
                    </x-animated-div>
                @endforeach
            </div>
        </div>
    </div>
</section>