@php
    if ($lastSouscription) {
        $expire = \Illuminate\Support\Carbon::parse($lastSouscription->DateHeureFin);
        $start = \Illuminate\Support\Carbon::parse($lastSouscription->DateHeureDebut);
        $now = now();

        // Durée totale de l'abonnement (inclus début et fin)
    $totalDays = max(1, $start->diffInDays($expire) + 1);

    // Jours utilisés
    $usedDaysRaw = $start->diffInDays(min($now, $expire));
    $usedDays = $usedDaysRaw + ($now->gte($start) ? 1 : 0); // inclure jour courant
    $usedDays = min($usedDays, $totalDays);

    // Jours restants
    $remaining = max(0, $totalDays - $usedDays);

    // Pourcentage
    $percent = intval(($usedDays / $totalDays) * 100);

    $statusColors = [
        'ACTIVE' => 'bg-green-100 text-green-700 ring-green-500/30',
        'EN ATTENTE DE PAIEMENT' => 'bg-amber-100 text-amber-700 ring-amber-500/30',
        'EXPIRE' => 'bg-red-100 text-red-700 ring-red-500/30',
        'INACTIVE' => 'bg-gray-200 text-gray-700 ring-gray-400/30',
    ];
    $badgeClass = $statusColors[$lastSouscription->Status] ?? 'bg-gray-200 text-gray-700';
    }
@endphp

@if ($lastSouscription)
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-5 space-y-5">
        <div class="flex flex-wrap items-center gap-3">
            <h3 class="text-base font-semibold flex items-center gap-2">
                <span>{{ $lastSouscription->plan->Titre }}</span>
                <span
                    class="text-xs font-medium px-2 py-0.5 rounded-full ring-1 {{ $badgeClass }}">{{ $lastSouscription->Status }}</span>
            </h3>
            <span class="text-xs text-gray-500">ID {{ $lastSouscription->id }}</span>
        </div>

        <div class="grid sm:grid-cols-4 gap-4 text-sm">
            <div>
                <p class="text-[11px] uppercase text-gray-500 font-semibold">Montant</p>
                <p class="font-medium text-gray-800">{{ money($lastSouscription->Montant) }}
                    {{ $lastSouscription->Devise }}</p>
            </div>
            <div>
                <p class="text-[11px] uppercase text-gray-500 font-semibold">Début</p>
                <p class="font-medium text-gray-800">{{ $start->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-[11px] uppercase text-gray-500 font-semibold">Fin</p>
                <p class="font-medium text-gray-800">{{ $expire->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-[11px] uppercase text-gray-500 font-semibold">Jours restants</p>
                <p class="font-medium {{ $remaining > 0 ? 'text-gray-800' : 'text-red-600' }}">{{ round($remaining) }}
                </p>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between text-xs mb-1">
                <span class="text-gray-500">Progression (jours)</span>
                <span class="font-medium text-gray-700">
                    {{ round($usedDays) }} / {{ $totalDays }}
                </span>
            </div>
            <div class="h-3 rounded-full bg-gray-100 overflow-hidden relative">
                <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-teal-500 to-cyan-500"
                    style="width: {{ $percent }}%"></div>
            </div>
        </div>


        <div>
            <h4 class="text-xs font-semibold uppercase text-gray-500 mb-2">Fonctionnalités incluses</h4>
            <ul class="text-sm grid sm:grid-cols-2 gap-1">
                @foreach ($lastSouscription->plan->getFeatures() as $feature)
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-teal-600 mt-0.5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7" />
                        </svg>
                        <span class="text-gray-700">{{ $feature }}</span>
                    </li>
                @endforeach
            </ul>

            @if ($lastSouscription->Status === 'ACTIVE' && $remaining <= 10 && $remaining > 0)
                <div class="mt-3 text-xs text-amber-600 flex items-center gap-1">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l2.5 2.5M12 6a9 9 0 1 0 0 18 9 9 0 0 0 0-18Z" />
                    </svg>
                    Renouvellement conseillé bientôt.
                </div>
            @endif
        </div>




    </div>
@else
    <div class="bg-white p-6 rounded-lg border border-dashed border-gray-300">
        <h5 class="text-lg font-semibold mb-1">Aucun abonnement actif</h5>
        <p class="text-sm text-gray-600 mb-4">Souscrivez pour débloquer toutes les ressources.</p>
        <button type="button" x-data @click="$dispatch('set-tab', 'soucrire')"
            class="px-4 py-2 rounded-md bg-teal-600 text-white text-sm hover:bg-teal-700">
            Choisir une formule
        </button>
    </div>
@endif
