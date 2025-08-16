{{-- resources/views/components/pricing-section.blade.php --}}

@php
    // $plans = [
    //     [
    //         'name' => 'Abonnement Journalier',
    //         'price' => '$15',
    //         'frequency' => '/jour',
    //         'priceSubtext' => '(0,5 $ par signal)',
    //         'features' => ['7 signaux par session', 'Accès immédiat après paiement', 'Code unique valable 24h'],
    //         'buttonText' => 'CHOISIR',
    //         'isPopular' => false,
    //     ],
    //     [
    //         'name' => 'Abonnement Hebdomadaire',
    //         'price' => '$84',
    //         'frequency' => '/semaine',
    //         'priceSubtext' => '(Économisez 21 $ vs le tarif journalier)',
    //         'features' => [
    //             '147 signaux sur 7 jours (21 signaux/jour)',
    //             'Accès illimité pendant 7 jours',
    //             'Support prioritaire',
    //         ],
    //         'buttonText' => 'CHOISIR',
    //         'isPopular' => true,
    //     ],
    //     [
    //         'name' => 'Abonnement Mensuel',
    //         'price' => '$315',
    //         'frequency' => '/mois',
    //         'priceSubtext' => '(Économisez 135 $ vs le tarif journalier)',
    //         'features' => [
    //             '630 signaux sur 30 jours (21 signaux/jour)',
    //             'Accès illimité + historique des signaux',
    //             'Statistiques de performance incluses',
    //         ],
    //         'buttonText' => 'CHOISIR',
    //         'isPopular' => false,
    //     ],
    // ];
@endphp

<section class=" ">
    <div class="mx-auto max-w-7xl">
        {{-- Conteneur avec le fond #0D192F --}}
        <div class="">
            <div class="isolate mx-auto  grid max-w-md grid-cols-1 gap-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach ($plans as $plan)
                    <div class="flex flex-col">
                        <div class="flex h-full flex-col rounded-[15px] bg-[#12141D] p-8 ring-1   'ring-white/10' ">
                            <h3 class="text-[20px] font-semibold leading-8 text-white">
                                {{ $plan->Titre }}
                            </h3>
                            <p class="mt-4 flex items-baseline gap-x-1">
                                <span class="text-[45px] font-bold tracking-tight text-white">
                                    {{ $plan->Prix }}
                                </span>
                                <span class="text-[20px] font-semibold leading-6 text-white">
                                    /{{ $plan->getFrequence() }}
                                </span>
                            </p>
                            <p class="mt-2 text-[15px] text-[#00AFFF]">
                                priceSubtext
                            </p>

                            <hr class="my-3 border-[#00AFFF]" />

                            <ul role="list" class="mt-8 space-y-3 text-[16px] font-bold leading-6 text-white">
                                @foreach ($plan->getFeatures() as $feature)
                                    <li class="flex gap-x-3">
                                        <img src="{{ asset('check.png') }}" alt="Checkmark" class="h-6 w-5">
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="flex-grow"></div>

                            <a href="#"
                                class="mt-8 block w-1/2 rounded-[10px] border border-[#00AFFF] px-3 py-3 text-center text-sm leading-6 transition-colors focus-visible:outline-2 focus-visible:outline-offset-2  bg-[#00AFFF] text-[#12141D] shadow-sm hover:bg-cyan-300 focus-visible:outline-[#00AFFF]' ">
                                CHOISIR
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
