@extends('layouts.app')
@section('pageTitle', 'Détail du plan')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-xl font-bold mb-6 text-gray-800">Détail du plan</h1>
            <div class="mb-4">
                <div class="text-lg font-semibold text-gray-700">{{ $plan->Titre }}</div>
                <div class="text-gray-600 mt-2"><span class="font-medium">Prix :</span> {{ $plan->Prix }}
                    {{ $plan->Devise }}</div>
                <div class="text-gray-600"><span class="font-medium">Durée :</span> {{ $plan->DureeEnJours }} jours</div>
                <div class="text-gray-600"><span class="font-medium">Nombre de signaux :</span> {{ $plan->NombreDeSignaux }}
                </div>
                <div class="text-gray-600"><span class="font-medium">Visibilité :</span> {{ $plan->Visibilite }}</div>
                <div class="text-gray-600 mt-2"><span class="font-medium">Autres avantages :</span>
                    <ul class="list-disc pl-5 mt-1">
                        @foreach ((array) $plan->AutresAvantages as $avantage)
                            <li>{{ $avantage }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="flex gap-2 mt-6">
                <a href="{{ route('plans.edit', $plan) }}"
                    class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition">Modifier</a>
                <form action="{{ route('plans.destroy', $plan) }}" method="POST"
                    onsubmit="return confirm('Supprimer ce plan ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">Supprimer</button>
                </form>
                <a href="{{ route('plans.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Retour</a>
            </div>
        </div>
    </div>
@endsection
