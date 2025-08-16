@extends('layouts.app')

@section('pageTitle', 'Détail du code d\'accès')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Détail du code d'accès</h1>
            <a href="{{ route('access-codes.index') }}"
                class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">
                <i class="ti ti-chevron-left mr-2"></i> Retour
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informations principales -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Informations principales</h2>

                    <div>
                        <span class="font-medium text-gray-600">Plan associé :</span>
                        <div class="mt-1">
                            @if ($accessCode->plan)
                                <span class="font-semibold text-blue-600">{{ $accessCode->plan->Titre }}</span>
                                <div class="text-sm text-gray-500">{{ $accessCode->plan->Prix }}
                                    {{ $accessCode->plan->Devise }}</div>
                            @else
                                <span class="text-red-500">Plan supprimé</span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <span class="font-medium text-gray-600">Code d'accès :</span>
                        <div class="mt-1">
                            <span
                                class="font-mono text-lg font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded">{{ $accessCode->Code }}</span>
                        </div>
                    </div>

                    <div>
                        <span class="font-medium text-gray-600">Durée en jours :</span>
                        <div class="mt-1">
                            <span class="text-gray-800">{{ $accessCode->DureeEnJours }} jours</span>
                        </div>
                    </div>
                </div>

                <!-- Utilisation et statut -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Utilisation et statut</h2>

                    <div>
                        <span class="font-medium text-gray-600">Utilisations :</span>
                        <div class="mt-2">
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-1">
                                <span>{{ $accessCode->Compteur }} / {{ $accessCode->CompteurMax }} utilisations</span>
                                <span>{{ $accessCode->CompteurMax > 0 ? round(($accessCode->Compteur / $accessCode->CompteurMax) * 100) : 0 }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-blue-600 h-3 rounded-full transition-all duration-300"
                                    style="width: {{ $accessCode->CompteurMax > 0 ? ($accessCode->Compteur / $accessCode->CompteurMax) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <span class="font-medium text-gray-600">Date d'expiration :</span>
                        <div class="mt-1">
                            @if ($accessCode->ExpireLe)
                                <span class="text-gray-800">{{ $accessCode->ExpireLe->format('d/m/Y') }}</span>
                                @if ($accessCode->ExpireLe->isPast())
                                    <span
                                        class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Expiré
                                    </span>
                                @else
                                    <span class="ml-2 text-sm text-gray-500">
                                        ({{ $accessCode->ExpireLe->diffForHumans() }})
                                    </span>
                                @endif
                            @else
                                <span class="text-gray-500">Non définie</span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <span class="font-medium text-gray-600">Statut :</span>
                        <div class="mt-1">
                            @php
                                $isExpired = $accessCode->ExpireLe && $accessCode->ExpireLe->isPast();
                                $isExhausted = $accessCode->Compteur >= $accessCode->CompteurMax;
                            @endphp
                            @if ($isExpired)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="ti ti-clock-x mr-1"></i> Expiré
                                </span>
                            @elseif($isExhausted)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                    <i class="ti ti-ban mr-1"></i> Épuisé
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="ti ti-check mr-1"></i> Actif
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <span class="font-medium text-gray-600">Créé le :</span>
                        <div class="mt-1 text-gray-800">{{ $accessCode->created_at->format('d/m/Y à H:i') }}</div>
                    </div>

                    @if ($accessCode->updated_at != $accessCode->created_at)
                        <div>
                            <span class="font-medium text-gray-600">Modifié le :</span>
                            <div class="mt-1 text-gray-800">{{ $accessCode->updated_at->format('d/m/Y à H:i') }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex gap-3">
                    <a href="{{ route('access-codes.edit', $accessCode) }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition">
                        <i class="ti ti-edit mr-2"></i> Modifier
                    </a>
                    <form action="{{ route('access-codes.destroy', $accessCode) }}" method="POST"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce code d\'accès ?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                            <i class="ti ti-trash mr-2"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto mt-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 flex items-center gap-2"><span>📜</span>
                Souscriptions utilisant ce code</h2>
            @if ($accessCode->souscriptions->isEmpty())
                <p class="text-sm text-gray-500">Aucune souscription n'a encore utilisé ce code.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left">Utilisateur</th>
                                <th class="px-3 py-2 text-left">Email</th>
                                <th class="px-3 py-2 text-left">Début</th>
                                <th class="px-3 py-2 text-left">Fin</th>
                                <th class="px-3 py-2 text-left">Statut</th>
                                <th class="px-3 py-2 text-left">Créé le</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($accessCode->souscriptions as $s)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-2">{{ $s->user?->name ?? '—' }}</td>
                                    <td class="px-3 py-2">{{ $s->user?->email ?? '—' }}</td>
                                    <td class="px-3 py-2">{{ $s->DateHeureDebut?->format('d/m/Y H:i') }}</td>
                                    <td class="px-3 py-2">{{ $s->DateHeureFin?->format('d/m/Y H:i') }}</td>
                                    <td class="px-3 py-2">
                                        @php
                                            $color = match ($s->Status) {
                                                'ACTIVE' => 'bg-green-100 text-green-700',
                                                'INACTIVE' => 'bg-yellow-100 text-yellow-700',
                                                'EXPIRED', 'EXPIRE' => 'bg-red-100 text-red-700',
                                                default => 'bg-gray-100 text-gray-600',
                                            };
                                        @endphp
                                        <span
                                            class="px-2 py-1 rounded text-xs font-semibold {{ $color }}">{{ $s->Status }}</span>
                                    </td>
                                    <td class="px-3 py-2">{{ $s->created_at?->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
