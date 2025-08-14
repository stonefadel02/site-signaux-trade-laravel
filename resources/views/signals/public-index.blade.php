@extends('layouts.app')

@section('pageTitle', 'Signaux de Trading')

@section('content')
    <div class="max-w-7xl mx-auto py-6">
        <!-- Header avec titre et date -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">📈 Signaux de Trading</h1>
                <p class="text-gray-600">Signaux en temps réel pour {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</p>
            </div>

            <!-- Sélecteur de date -->
            <div class="mt-4 md:mt-0">
                <form method="GET" action="{{ route('signaux') }}" class="flex items-center gap-2">
                    <input type="date" name="date" value="{{ $date }}"
                        class="rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        onchange="this.form.submit()">
                    <button type="button"
                        onclick="window.location.href='{{ route('signaux', ['date' => now()->format('Y-m-d')]) }}'"
                        class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Aujourd'hui
                    </button>
                </form>
            </div>
        </div>

        <!-- Statistiques du jour -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $stats['total'] }}</div>
                <div class="text-sm text-gray-500">Total signaux</div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-green-600">{{ $stats['win'] }}</div>
                <div class="text-sm text-gray-500">Gagnants</div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-red-600">{{ $stats['lose'] }}</div>
                <div class="text-sm text-gray-500">Perdants</div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
                <div class="text-sm text-gray-500">En attente</div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-purple-600">{{ $stats['win_rate'] }}%</div>
                <div class="text-sm text-gray-500">Taux de réussite</div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="flex justify-center gap-2 mb-1">
                    <span class="text-green-600 font-bold">{{ $stats['buy_signals'] }}</span>
                    <span class="text-gray-400">|</span>
                    <span class="text-red-600 font-bold">{{ $stats['sell_signals'] }}</span>
                </div>
                <div class="text-sm text-gray-500">BUY | SELL</div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form method="GET" action="{{ route('signaux') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <input type="hidden" name="date" value="{{ $date }}">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Actif</label>
                    <input type="text" name="actif" value="{{ request('actif') }}" placeholder="EUR/USD, BTC/USDT..."
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Direction</label>
                    <select name="direction"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Toutes</option>
                        <option value="BUY" {{ request('direction') == 'BUY' ? 'selected' : '' }}>BUY</option>
                        <option value="SELL" {{ request('direction') == 'SELL' ? 'selected' : '' }}>SELL</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tous</option>
                        <option value="EN COURS" {{ request('status') == 'EN COURS' ? 'selected' : '' }}>En cours</option>
                        <option value="EN ATTENTE" {{ request('status') == 'EN ATTENTE' ? 'selected' : '' }}>En attente
                        </option>
                        <option value="TERMINE" {{ request('status') == 'TERMINE' ? 'selected' : '' }}>Terminé</option>
                        <option value="ANNULE" {{ request('status') == 'ANNULE' ? 'selected' : '' }}>Annulé</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Résultat</label>
                    <select name="resultat"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tous</option>
                        <option value="WIN" {{ request('resultat') == 'WIN' ? 'selected' : '' }}>WIN</option>
                        <option value="LOSE" {{ request('resultat') == 'LOSE' ? 'selected' : '' }}>LOSE</option>
                        <option value="PENDING" {{ request('resultat') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                        <option value="BREAK-EVEN" {{ request('resultat') == 'BREAK-EVEN' ? 'selected' : '' }}>BREAK-EVEN
                        </option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Filtrer
                    </button>
                    <a href="{{ route('signaux', ['date' => $date]) }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Actifs les plus tradés -->
        @if ($topActifs->count() > 0)
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">🔥 Actifs les plus tradés aujourd'hui</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($topActifs as $actif)
                        <a href="{{ route('signaux', ['date' => $date, 'actif' => $actif->Actifs]) }}"
                            class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm hover:bg-blue-200 transition">
                            {{ $actif->Actifs }} ({{ $actif->total }})
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Liste des signaux -->
        <div class="space-y-4">
            @forelse($signals as $signal)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow
                {{ $signal->DateHeureEmission > now()->subMinutes(5) ? 'ring-2 ring-blue-200' : '' }}"
                    data-recent="{{ $signal->DateHeureEmission > now()->subMinutes(5) ? 'true' : 'false' }}">

                    <!-- Version Mobile -->
                    <div class="block lg:hidden p-4">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-lg text-gray-900">{{ $signal->Actifs }}</span>
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    {{ $signal->Direction == 'BUY' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        @if ($signal->Direction == 'BUY')
                                            📈 BUY
                                        @else
                                            📉 SELL
                                        @endif
                                    </span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $signal->DateHeureEmission->format('H:i') }}
                                    @if ($signal->Timeframe)
                                        • {{ $signal->Timeframe }}
                                    @endif
                                </div>
                            </div>

                            <div class="text-right">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                @switch($signal->Resultat)
                                    @case('WIN')
                                        bg-green-100 text-green-800
                                        @break
                                    @case('LOSE')
                                        bg-red-100 text-red-800
                                        @break
                                    @case('BREAK-EVEN')
                                        bg-yellow-100 text-yellow-800
                                        @break
                                    @default
                                        bg-gray-100 text-gray-800
                                @endswitch">
                                    @switch($signal->Resultat)
                                        @case('WIN')
                                            ✅ WIN
                                        @break

                                        @case('LOSE')
                                            ❌ LOSE
                                        @break

                                        @case('BREAK-EVEN')
                                            ⚖️ BE
                                        @break

                                        @default
                                            ⏳ {{ $signal->Resultat }}
                                    @endswitch
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">Entrée:</span>
                                <span
                                    class="font-mono font-semibold block">{{ number_format($signal->PrixEntree, 5) }}</span>
                            </div>
                            @if ($signal->Confiance)
                                <div>
                                    <span class="text-gray-500">Confiance:</span>
                                    <span class="font-semibold block">{{ $signal->Confiance }}%</span>
                                </div>
                            @endif
                            @if ($signal->TakeProfit)
                                <div>
                                    <span class="text-green-600">TP:</span>
                                    <span
                                        class="font-mono text-sm block">{{ number_format($signal->TakeProfit, 5) }}</span>
                                </div>
                            @endif
                            @if ($signal->StopLoss)
                                <div>
                                    <span class="text-red-600">SL:</span>
                                    <span class="font-mono text-sm block">{{ number_format($signal->StopLoss, 5) }}</span>
                                </div>
                            @endif
                        </div>

                        @if ($signal->Pips)
                            <div class="mt-2 text-sm">
                                <span class="text-gray-500">Pips:</span>
                                <span
                                    class="font-semibold {{ $signal->Resultat == 'WIN' ? 'text-green-600' : ($signal->Resultat == 'LOSE' ? 'text-red-600' : 'text-gray-600') }}">
                                    {{ $signal->Pips > 0 ? '+' : '' }}{{ $signal->Pips }}
                                </span>
                            </div>
                        @endif

                        <div class="mt-3 flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                            @switch($signal->Status)
                                @case('EN COURS')
                                    bg-blue-100 text-blue-800
                                    @break
                                @case('TERMINE')
                                    bg-gray-100 text-gray-800
                                    @break
                                @case('ANNULE')
                                    bg-red-100 text-red-800
                                    @break
                                @default
                                    bg-yellow-100 text-yellow-800
                            @endswitch">
                                {{ $signal->Status }}
                            </span>

                            @if ($signal->Status == 'EN COURS' && $signal->DateHeureExpire > now())
                                <span class="text-xs text-gray-500">
                                    Expire {{ $signal->DateHeureExpire->diffForHumans() }}
                                </span>
                            @endif
                        </div>

                        @if ($signal->Commentaire)
                            <div class="mt-3 pt-3 border-t border-gray-200">
                                <div class="text-sm text-gray-600">
                                    <span class="font-medium">💬</span> {{ $signal->Commentaire }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Version Desktop -->
                    <div class="hidden lg:block p-6">
                        <div class="grid grid-cols-12 gap-4 items-center">

                            <!-- Heure et actif -->
                            <div class="col-span-2">
                                <div class="text-sm text-gray-500">{{ $signal->DateHeureEmission->format('H:i') }}</div>
                                <div class="font-bold text-lg text-gray-900">{{ $signal->Actifs }}</div>
                                @if ($signal->Timeframe)
                                    <div class="text-xs text-gray-500">{{ $signal->Timeframe }}</div>
                                @endif
                            </div>

                            <!-- Direction -->
                            <div class="col-span-1">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $signal->Direction == 'BUY' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    @if ($signal->Direction == 'BUY')
                                        📈 BUY
                                    @else
                                        📉 SELL
                                    @endif
                                </span>
                            </div>

                            <!-- Prix d'entrée -->
                            <div class="col-span-2">
                                <div class="text-sm text-gray-500">Prix d'entrée</div>
                                <div class="font-semibold text-gray-900 font-mono">
                                    {{ number_format($signal->PrixEntree, 5) }}</div>
                            </div>

                            <!-- Take Profit / Stop Loss -->
                            <div class="col-span-2">
                                <div class="space-y-1">
                                    @if ($signal->TakeProfit)
                                        <div class="text-xs">
                                            <span class="text-green-600 font-medium">TP:</span>
                                            <span class="font-mono">{{ number_format($signal->TakeProfit, 5) }}</span>
                                        </div>
                                    @endif
                                    @if ($signal->StopLoss)
                                        <div class="text-xs">
                                            <span class="text-red-600 font-medium">SL:</span>
                                            <span class="font-mono">{{ number_format($signal->StopLoss, 5) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Confiance -->
                            <div class="col-span-1">
                                @if ($signal->Confiance)
                                    <div class="text-sm text-gray-500">Confiance</div>
                                    <div class="flex items-center">
                                        <div class="text-lg font-semibold">{{ $signal->Confiance }}%</div>
                                        <div class="ml-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $signal->Confiance / 20)
                                                    ⭐
                                                @else
                                                    ☆
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Résultat -->
                            <div class="col-span-2">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @switch($signal->Resultat)
                                    @case('WIN')
                                        bg-green-100 text-green-800
                                        @break
                                    @case('LOSE')
                                        bg-red-100 text-red-800
                                        @break
                                    @case('BREAK-EVEN')
                                        bg-yellow-100 text-yellow-800
                                        @break
                                    @default
                                        bg-gray-100 text-gray-800
                                @endswitch">
                                    @switch($signal->Resultat)
                                        @case('WIN')
                                            ✅ {{ $signal->Resultat }}
                                        @break

                                        @case('LOSE')
                                            ❌ {{ $signal->Resultat }}
                                        @break

                                        @case('BREAK-EVEN')
                                            ⚖️ {{ $signal->Resultat }}
                                        @break

                                        @default
                                            ⏳ {{ $signal->Resultat }}
                                    @endswitch
                                </span>

                                @if ($signal->Pips)
                                    <div
                                        class="text-xs mt-1 font-medium
                                    {{ $signal->Resultat == 'WIN' ? 'text-green-600' : ($signal->Resultat == 'LOSE' ? 'text-red-600' : 'text-gray-600') }}">
                                        {{ $signal->Pips > 0 ? '+' : '' }}{{ $signal->Pips }} pips
                                    </div>
                                @endif
                            </div>

                            <!-- Statut -->
                            <div class="col-span-2">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                                @switch($signal->Status)
                                    @case('EN COURS')
                                        bg-blue-100 text-blue-800
                                        @break
                                    @case('TERMINE')
                                        bg-gray-100 text-gray-800
                                        @break
                                    @case('ANNULE')
                                        bg-red-100 text-red-800
                                        @break
                                    @default
                                        bg-yellow-100 text-yellow-800
                                @endswitch">
                                    {{ $signal->Status }}
                                </span>

                                <!-- Temps restant si en cours -->
                                @if ($signal->Status == 'EN COURS' && $signal->DateHeureExpire > now())
                                    <div class="text-xs text-gray-500 mt-1">
                                        Expire {{ $signal->DateHeureExpire->diffForHumans() }}
                                    </div>
                                @endif
                            </div>

                        </div>

                        <!-- Commentaire -->
                        @if ($signal->Commentaire)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="text-sm text-gray-600">
                                    <span class="font-medium">💬 Analyse :</span> {{ $signal->Commentaire }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @empty
                    <div class="bg-white rounded-lg shadow p-12 text-center">
                        <div class="text-6xl mb-4">📊</div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun signal trouvé</h3>
                        <p class="text-gray-500">Aucun signal de trading n'a été émis pour cette date et ces filtres.</p>
                        @if ($date != now()->format('Y-m-d'))
                            <a href="{{ route('signaux', ['date' => now()->format('Y-m-d')]) }}"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Voir les signaux d'aujourd'hui
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($signals->hasPages())
                <div class="mt-8">
                    {{ $signals->appends(request()->query())->links() }}
                </div>
            @endif
        </div>

        <!-- Auto-refresh pour les signaux en cours -->
        <script>
            // Notification sonore
            function playNotificationSound() {
                // Créer un son de notification simple
                const audioContext = new(window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);

                oscillator.frequency.value = 800;
                oscillator.type = 'sine';

                gainNode.gain.setValueAtTime(0, audioContext.currentTime);
                gainNode.gain.linearRampToValueAtTime(0.1, audioContext.currentTime + 0.1);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);

                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.5);
            }

            // Compteur de signaux pour détecter les nouveaux
            let currentSignalCount = {{ $signals->count() }};

            // Fonction de mise à jour
            function updateSignals() {
                if (document.hidden) return; // Ne pas mettre à jour si l'onglet n'est pas actif

                fetch(window.location.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newSignalsContainer = doc.querySelector('.space-y-4');
                        const newSignalCount = newSignalsContainer.children.length;

                        // Vérifier s'il y a de nouveaux signaux
                        if (newSignalCount > currentSignalCount) {
                            // Nouveau signal détecté !
                            playNotificationSound();

                            // Afficher une notification navigateur si permission accordée
                            if (Notification.permission === 'granted') {
                                new Notification('📈 Nouveau Signal de Trading !', {
                                    body: 'Un nouveau signal vient d\'être publié.',
                                    icon: '/favicon.ico'
                                });
                            }

                            // Mettre à jour la page
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }

                        currentSignalCount = newSignalCount;
                    })
                    .catch(error => {
                        console.error('Erreur lors de la mise à jour:', error);
                    });
            }

            // Refresh automatique toutes les 15 secondes si on regarde les signaux d'aujourd'hui
            @if ($date == now()->format('Y-m-d'))
                setInterval(updateSignals, 15000);
            @endif

            // Demander la permission pour les notifications
            document.addEventListener('DOMContentLoaded', function() {
                // Demander la permission pour les notifications navigateur
                if ('Notification' in window && Notification.permission === 'default') {
                    Notification.requestPermission();
                }

                // Ajouter une animation aux signaux récents (moins de 5 minutes)
                const recentSignals = document.querySelectorAll('[data-recent="true"]');
                recentSignals.forEach(signal => {
                    signal.classList.add('animate-pulse');
                    setTimeout(() => {
                        signal.classList.remove('animate-pulse');
                    }, 5000);
                });

                // Indicateur de dernière mise à jour
                const updateIndicator = document.createElement('div');
                updateIndicator.id = 'update-indicator';
                updateIndicator.className =
                    'fixed bottom-4 right-4 bg-blue-600 text-white px-3 py-2 rounded-lg shadow-lg text-sm';
                updateIndicator.innerHTML = '🔄 Dernière MAJ: ' + new Date().toLocaleTimeString();
                document.body.appendChild(updateIndicator);

                // Masquer l'indicateur après 3 secondes
                setTimeout(() => {
                    updateIndicator.style.opacity = '0.7';
                }, 3000);
            });

            // Masquer/afficher l'indicateur selon l'activité
            document.addEventListener('visibilitychange', function() {
                const indicator = document.getElementById('update-indicator');
                if (indicator) {
                    indicator.style.display = document.hidden ? 'none' : 'block';
                }
            });
        </script>

        <!-- CSS pour les animations -->
        <style>
            @keyframes newSignal {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.02);
                }

                100% {
                    transform: scale(1);
                }
            }

            .new-signal {
                animation: newSignal 0.6s ease-in-out;
            }

            .signal-card:hover {
                transform: translateY(-2px);
                transition: transform 0.2s ease-in-out;
            }

            /* Effet de pulsation pour les signaux en cours */
            .pulse-live {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.8;
                }
            }
        </style>

    @endsection
