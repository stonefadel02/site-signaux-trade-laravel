@extends('layouts.app')
@section('pageTitle', 'Souscriptions (Administration)')
@section('content')
    <div class="max-w-7xl mx-auto mt-8 space-y-6">
        <div class="bg-white p-6 rounded shadow space-y-6">
            <h1 class="text-xl font-semibold">Historique des souscriptions</h1>
            <form method="GET" action="{{ route('admin.souscriptions.index') }}" class="grid md:grid-cols-6 gap-4 items-end">
                <div class="md:col-span-2">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Recherche globale</label>
                    <input type="text" name="q" value="{{ $search }}"
                        placeholder="Email, nom, code, montant..." class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Du</label>
                    <input type="date" name="from" value="{{ $from }}"
                        class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Au</label>
                    <input type="date" name="to" value="{{ $to }}"
                        class="w-full border rounded px-3 py-2">
                </div>
                <div class="flex gap-2 md:col-span-2">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filtrer</button>
                    <a href="{{ route('admin.souscriptions.index') }}"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Réinitialiser</a>
                </div>
            </form>
            <div class="flex flex-wrap gap-4 text-sm">
                <div class="px-3 py-2 bg-gray-50 rounded border">Total: <span
                        class="font-semibold">{{ $total }}</span></div>
                <div class="px-3 py-2 bg-gray-50 rounded border">Montant cumulé: <span
                        class="font-semibold">{{ number_format($montantTotal, 2, ',', ' ') }}</span></div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 text-left">Début</th>
                            <th class="px-3 py-2 text-left">Fin</th>
                            <th class="px-3 py-2 text-left">Utilisateur</th>
                            <th class="px-3 py-2 text-left">Plan</th>
                            <th class="px-3 py-2 text-left">Montant</th>
                            <th class="px-3 py-2 text-left">Code</th>
                            <th class="px-3 py-2 text-left">Statut</th>
                            <th class="px-3 py-2 text-left">Créé le</th>
                            <th class="px-3 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($souscriptions as $s)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">{{ $s->DateHeureDebut?->format('d/m/Y H:i') }}</td>
                                <td class="px-3 py-2">{{ $s->DateHeureFin?->format('d/m/Y H:i') }}</td>
                                <td class="px-3 py-2">
                                    <div class="font-medium">{{ $s->user?->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $s->user?->email }}</div>
                                </td>
                                <td class="px-3 py-2">{{ $s->plan?->Titre }}</td>
                                <td class="px-3 py-2">{{ number_format($s->Montant, 2, ',', ' ') }} {{ $s->Devise }}
                                </td>
                                <td class="px-3 py-2">{{ $s->AccessCode ?? '—' }}</td>
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
                                <td class="px-3 py-2">
                                    @if ($s->Status === 'ACTIVE')
                                        <form method="POST" action="{{ route('admin.souscriptions.deactivate', $s) }}"
                                            onsubmit="return confirm('Désactiver cette souscription ?');">
                                            @csrf
                                            <button type="submit"
                                                class="text-xs px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">Désactiver</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-3 py-6 text-center text-gray-500">Aucune souscription trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $souscriptions->links() }}</div>
        </div>
    </div>
@endsection
