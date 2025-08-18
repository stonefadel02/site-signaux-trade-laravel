@extends('layouts.app')

@section('pageTitle', 'Dashboard')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="space-y-8">

                {{-- 1. Section : Statut de l'abonnement --}}
                @if ($souscription)
                    <div class="rounded-lg bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">Statut de l'abonnement</h3>
                            <span
                                class="flex items-center gap-2 rounded-full {{ $souscription->isActive() ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} px-3 py-1 text-xs font-semibold">
                                <span
                                    class="h-2 w-2 rounded-full {{ $souscription->isActive() ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{ $souscription->Status }}
                            </span>
                        </div>
                        <div class="mt-4">
                            @php
                                // Calcul final et infaillible du pourcentage
                                $start = $souscription->DateHeureDebut->timestamp;
                                $end = $souscription->DateHeureFin->timestamp;
                                $now = now()->timestamp;

                                $totalDuration = $end - $start;
                                $elapsedDuration = $now - $start;

                                $progress = 0; // Par défaut à 0
                                if ($totalDuration > 0) {
                                    // On s'assure que le progrès est entre 0 et 100
    $progress = max(0, min(100, ($elapsedDuration / $totalDuration) * 100));
} elseif ($now >= $end) {
    $progress = 100; // Si l'abonnement est terminé, la barre est pleine
                                }
                            @endphp
                            <div class="relative h-2 w-full rounded-full bg-gray-200">
                                <div class="absolute left-0 top-0 h-2 rounded-full bg-red-500"
                                    style="width: {{ $progress }}%;"></div>
                            </div>
                            <div class="mt-2 flex items-center justify-between text-sm text-gray-500">
                                <span>Expire dans :</span>
                                <span
                                    class="font-semibold text-gray-800">{{ $souscription->tempsRestantPourHumains() }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="rounded-lg bg-white p-6 text-center shadow-sm">
                        <p class="text-gray-600">Vous n'avez aucun abonnement actif.</p>
                        <a href="#"
                            class="mt-4 inline-block rounded-md bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-cyan-500">
                            Voir les plans d'abonnement
                        </a>
                    </div>
                @endif

                {{-- 2. Section : Prochaine session --}}
                @if ($prochaineSession)
                    <div class="rounded-lg bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">Prochaine session de signaux</h3>
                            <span class="text-sm font-medium text-gray-500">Prochaine session : <span
                                    class="rounded-md bg-gray-200 px-2 py-1 text-gray-700">{{ $prochaineSession->Titre }}
                                    ({{ \Carbon\Carbon::parse($prochaineSession->HeureDebut)->format('H:i') }}
                                    GMT+0)</span></span>
                        </div>
                        <div class="mt-4 text-center" x-data="timer('{{ \Carbon\Carbon::parse($prochaineSession->HeureDebut)->tz('UTC')->toIso8601String() }}')" x-init="init()">
                            <p class="text-sm text-gray-500">Temps restant :</p>
                            <p class="text-4xl font-bold tracking-wider text-gray-800">
                                <span x-text="time().hours"></span>h
                                <span x-text="time().minutes"></span>m
                                <span x-text="time().seconds"></span>s
                            </p>
                        </div>
                    </div>
                @endif

                {{-- 3. Section : Accès aux signaux --}}
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Aperçu des derniers signaux</h3>
                        <a href="{{ route('signaux') }}"
                            class="flex items-center gap-2 rounded-md bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-cyan-500">
                            Voir tous les Signaux
                            <i class="fa-solid fa-arrow-right h-4 w-4"></i>
                        </a>
                    </div>
                    <div class="mt-4 flow-root">
                        <div class="-mx-6 -my-2 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr class="text-left text-sm font-semibold text-gray-500">
                                            {{-- On utilise les mêmes entêtes que sur la page des signaux --}}
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                Date d'émission</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                Session</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                Paire</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                Direction</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @forelse ($signaux as $signal)
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
                                                    {{ $signal->Direction === 'BUY' ? 'ACHAT' : 'VENTE' }}
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                                    {{-- On lie le bouton GO! vers la page de détail du signal --}}
                                                    <a href="{{ route('signals.public.show', $signal) }}"
                                                        class="rounded-md bg-gray-800 px-4 py-1.5 text-white shadow-sm hover:bg-gray-700">
                                                        GO !
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                    @if ($souscription)
                                                        Aucun signal récent disponible.
                                                    @else
                                                        Veuillez souscrire à un plan pour voir les signaux.
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- 4. Notification d'alerte en bas --}}
                @if ($souscription && $souscription->isActive() && $souscription->DateHeureFin->diffInDays(now()) <= 5)
                    <div class="flex items-center gap-4 rounded-lg bg-yellow-100 p-4 text-sm text-yellow-800">
                        <i class="fa-solid fa-triangle-exclamation h-6 w-6 flex-shrink-0 text-yellow-600"></i>
                        <p>
                            <span class="font-semibold">Attention :</span> Votre abonnement expire dans
                            {{-- On appelle la nouvelle méthode --}}
                            <span class="font-bold">{{ $souscription->tempsRestantPourHumains() }}</span> !
                            Pensez à le renouveler.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Script pour le compte à rebours (à mettre dans un @push('scripts') si votre layout le supporte) --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('timer', (expiry) => ({
                expiry: expiry,
                remaining: null,
                init() {
                    this.setRemaining();
                    setInterval(() => {
                        this.setRemaining();
                    }, 1000);
                },
                setRemaining() {
                    const diff = new Date(this.expiry) - new Date();
                    if (diff < 0) {
                        // S'arrête à zéro au lieu de devenir négatif
                        this.remaining = 0;
                        return;
                    }
                    this.remaining = diff;
                },
                time() {
                    return {
                        hours: Math.floor(this.remaining / 3600000).toString().padStart(2, '0'),
                        minutes: Math.floor((this.remaining % 3600000) / 60000).toString().padStart(2,
                            '0'),
                        seconds: Math.floor((this.remaining % 60000) / 1000).toString().padStart(2,
                            '0'),
                    }
                },
            }))
        })
    </script>
@endsection
