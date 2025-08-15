@if ($lastSouscription)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Carte 1 -->
        <div
            class="flex items-center justify-between p-4 border {{ $lastSouscription->Status === 'ACTIVE' ? 'border-green-400' : 'border-red-400' }} bg-green-100 rounded-lg w-full">
            <div>
                <p class="text-sm text-gray-700">Statut de l’abonnement</p>
                <p class="text-lg font-semibold"> {{ $lastSouscription->Status }} </p>
            </div>
            @if ($lastSouscription->Status === 'ACTIVE')
                <div class="text-green-500 text-3xl">
                    ✔
                </div>
            @else
                <div class="text-red-500 text-3xl">
                    ✖
                </div>
            @endif

        </div>

        <!-- Carte 2 -->
        <div class="flex items-center justify-between p-4 border border-blue-400 bg-blue-100 rounded-lg w-full">
            <div>
                <p class="text-sm text-blue-600">Plan {{ $lastSouscription->plan->Nom }}</p>
                <p class="text-lg font-bold">{{ $lastSouscription->Montant }} {{ $lastSouscription->Devise }}</p>
            </div>
            <div class="text-blue-600 text-4xl font-bold">
                ₿
            </div>
        </div>

        <!-- Carte 3 -->
        <div class="p-4 border border-blue-400 bg-blue-100 rounded-lg w-full">
            <ul class="space-y-2 text-sm text-gray-700">
                <li class="flex items-center gap-2">
                    <span class="text-blue-600">✔</span>
                    10 signaux par session
                </li>
                <li class="flex items-center gap-2">
                    <span class="text-blue-600">✔</span>
                    Accès immédiat après paiement
                </li>
                <li class="flex items-center gap-2">
                    <span class="text-blue-600">✔</span>
                    Code unique valable 24h
                </li>
            </ul>
        </div>
    </div>
@else
    <div class="bg-white p-4 border border-gray-300 rounded-lg">
        <h5>Aucun abonnement actif</h5>
        <p class="text-sm text-gray-700">Vous n'avez pas d'abonnement actif pour le moment</p>

    </div>
@endif
