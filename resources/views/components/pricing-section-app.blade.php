{{-- resources/views/components/pricing-section.blade.php --}}

<section class="">
    <div class="mx-auto max-w-7xl">
        <div class="">
            @php
                $activePlan = !is_null($lastSouscription) && $lastSouscription->isActive() ? $lastSouscription : null;
            @endphp
            <div class="isolate mx-auto grid max-w-md grid-cols-1 gap-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach ($plans as $plan)
                    <div class="flex flex-col">
                        @php
                            $planId = is_array($plan) ? $plan['id'] ?? null : $plan->id ?? null;
                            $planTitre = is_array($plan) ? $plan['Titre'] ?? '' : $plan->Titre ?? '';
                            $planPrix = is_array($plan) ? $plan['Prix'] ?? 0 : $plan->Prix ?? 0;
                            $planDevise = is_array($plan) ? $plan['Devise'] ?? null : $plan->Devise ?? null;
                            if (is_array($plan)) {
                                $planFrequence = $plan['frequence'] ?? ($plan['Frequence'] ?? '');
                                $planFeatures = $plan['features'] ?? [];
                            } else {
                                $planFrequence = method_exists($plan, 'getFrequence')
                                    ? $plan->getFrequence()
                                    : $plan->Frequence ?? '';
                                $planFeatures = method_exists($plan, 'getFeatures') ? $plan->getFeatures() : [];
                            }
                            $priceSubtext = is_array($plan)
                                ? $plan['price_subtext'] ?? null
                                : $plan->price_subtext ?? null;
                            $isPopular = is_array($plan) ? $plan['isPopular'] ?? false : $plan->isPopular ?? false;
                            $isLast = ($lastSouscription?->plan_id ?? null) === $planId;
                            $isActive = $isLast && $lastSouscription && $lastSouscription->isActive();
                        @endphp
                        <div
                            class="flex h-full flex-col rounded-[15px] relative {{ $isPopular ? 'border-2 border-[#00AFFF] shadow ring-[#00AFFF] ring' : '' }} bg-[#12141D] p-8 ring-1 ring-white/10">

                            {{-- Nom du plan --}}
                            <h3 class="text-[20px] font-semibold leading-8 text-white">
                                {{ $planTitre }}
                                @if ($isActive)
                                    <span
                                        class=" ml-2 text-white inline-block text-[11px] px-2 py-0.5 rounded bg-white/20 border border-white/30 uppercase tracking-wide">ACTIVE</span>
                                @endif
                            </h3>

                            {{-- Prix --}}
                            <p class="mt-4 flex items-baseline gap-x-1">
                                <span class="text-[45px] font-bold tracking-tight text-white">
                                    {{ money($planPrix, $planDevise) }}
                                </span>
                                <span class="text-[20px] font-semibold leading-6 text-white">
                                    /{{ $planFrequence }}
                                </span>
                            </p>

                            {{-- Sous-texte prix si dispo --}}
                            @if ($priceSubtext)
                                <p class="mt-2 text-[15px] {{ $isPopular ? 'text-[#12141D]' : 'text-[#00AFFF]' }}">
                                    {{ $priceSubtext }}
                                </p>
                            @endif

                            <hr class="my-3 border-[#00AFFF]" />

                            {{-- Features --}}
                            <ul role="list" class="mt-8 space-y-3 text-[16px] font-bold leading-6 text-white">
                                @foreach ($planFeatures as $feature)
                                    <li class="flex gap-x-3">
                                        <img src="{{ asset('check.png') }}" alt="Checkmark" class="h-6 w-5">
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="flex-grow"></div>

                            {{-- Bouton choisir -> lance le paiement (via SweetAlert) --}}
                            <form action="{{ route('paiement.initier') }}" method="POST"
                                class="mt-8 !uppercase js-payment-form">
                                @csrf
                                <input type="hidden" name="first_name">
                                <input type="hidden" name="last_name">
                                <input type="hidden" name="email_name">
                                <input type="hidden" name="switch_mode"> {{-- immediate | scheduled (for change offer) --}}
                                <input type="hidden" name="action_type"> {{-- renew | reactivate | choose | change-offer --}}
                                <input type="hidden" name="plan_id" value="{{ $planId }}">

                                @if ($isLast)
                                    @if ($isActive)
                                        <button type="button"
                                            class="block w-full rounded-[10px] border  px-3 py-3 text-center text-sm leading-6 transition-colors bg-white text-[#12141D] shadow-sm hover:bg-cyan-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#00AFFF]"
                                            data-action="renew" data-plan-id="{{ $planId }}"
                                            data-plan-title="{{ e($planTitre) }}"
                                            data-amount-display="{{ money($planPrix, $planDevise) }}"
                                            data-user-first="{{ e(auth()->user()->first_name ?? '') }}"
                                            data-user-last="{{ e(auth()->user()->last_name ?? '') }}"
                                            data-user-email="{{ e(auth()->user()->email ?? '') }}"
                                            data-user-name="{{ e(auth()->user()->name ?? '') }}">
                                            PROLONGER LA DURÉE
                                        </button>
                                    @else
                                        <button type="button"
                                            class="block w-full rounded-[10px] border  px-3 py-3 text-center text-sm leading-6 transition-colors bg-white text-[#12141D] shadow-sm hover:bg-cyan-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#00AFFF]"
                                            data-action="renew" data-plan-id="{{ $planId }}"
                                            data-plan-title="{{ e($planTitre) }}"
                                            data-amount-display="{{ money($planPrix, $planDevise) }}"
                                            data-user-first="{{ e(auth()->user()->first_name ?? '') }}"
                                            data-user-last="{{ e(auth()->user()->last_name ?? '') }}"
                                            data-user-email="{{ e(auth()->user()->email ?? '') }}"
                                            data-user-name="{{ e(auth()->user()->name ?? '') }}">
                                            REACTIVER
                                        </button>
                                    @endif
                                @else
                                    <button type="button"
                                        class="block w-full rounded-[10px] border px-3 py-3 text-center text-sm leading-6 transition-colors {{ $isPopular ? 'bg-white text-[#12141D] border-white hover:bg-cyan-100' : 'bg-[#00AFFF] text-[#12141D] border-[#00AFFF] hover:bg-cyan-300' }} focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#00AFFF]"
                                        data-action="{{ $activePlan && $activePlan->id !== $planId ? 'change-offer' : 'choose' }}"
                                        data-plan-id="{{ $planId }}" data-plan-title="{{ e($planTitre) }}"
                                        data-amount-display="{{ money($planPrix, $planDevise) }}"
                                        data-user-first="{{ e(auth()->user()->first_name ?? '') }}"
                                        data-user-last="{{ e(auth()->user()->last_name ?? '') }}"
                                        data-user-email="{{ e(auth()->user()->email ?? '') }}"
                                        data-user-name="{{ e(auth()->user()->name ?? '') }}">
                                        @if ($activePlan && $activePlan->id !== $planId)
                                            CHANGER D'OFFRE
                                        @else
                                            CHOISIR
                                        @endif
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<x-payment-modal />
