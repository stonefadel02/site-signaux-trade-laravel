@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-xl font-bold mb-6 text-gray-800">Détail de la session de signaux</h1>
            <div class="mb-4">
                <div class="text-lg font-semibold text-gray-700">{{ $sessionSignal->Titre }}</div>
                <div class="text-gray-600 mt-2"><span class="font-medium">Heure Début :</span>
                    {{ $sessionSignal->HeureDebut }}</div>
                <div class="text-gray-600"><span class="font-medium">Heure Fin :</span> {{ $sessionSignal->HeureFin }}</div>
            </div>
            <div class="flex gap-2 mt-6">
                <a href="{{ route('session-signals.edit', $sessionSignal) }}"
                    class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition">Modifier</a>
                <form action="{{ route('session-signals.destroy', $sessionSignal) }}" method="POST"
                    onsubmit="return confirm('Supprimer cette session ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">Supprimer</button>
                </form>
                <a href="{{ route('session-signals.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Retour</a>
            </div>
        </div>
    </div>
@endsection
