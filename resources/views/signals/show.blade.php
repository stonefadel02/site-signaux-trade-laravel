@extends('layouts.app')
@section('pageTitle', 'Détail du signal')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-xl font-bold mb-6 text-gray-800">Détail du signal</h1>
            <div class="mb-4">
                <div class="text-lg font-semibold text-gray-700">Signal #{{ $signal->id }}</div>
                <div class="text-gray-600 mt-2"><span class="font-medium">User :</span> {{ $signal->user_id }}</div>
                <div class="text-gray-600"><span class="font-medium">Session :</span> {{ $signal->session_id }}</div>
                <div class="text-gray-600"><span class="font-medium">Date/Heure Emission :</span>
                    {{ $signal->DateHeureEmission }}</div>
                <div class="text-gray-600"><span class="font-medium">Date/Heure Expire :</span>
                    {{ $signal->DateHeureExpire }}</div>
                <div class="text-gray-600"><span class="font-medium">Durée Trade :</span> {{ $signal->DureeTrade }}</div>
                <div class="text-gray-600"><span class="font-medium">Actifs :</span> {{ $signal->Actifs }}</div>
                <div class="text-gray-600"><span class="font-medium">Timeframe :</span> {{ $signal->Timeframe }}</div>
                <div class="text-gray-600"><span class="font-medium">Prix Entrée :</span> {{ $signal->PrixEntree }}</div>
                <div class="text-gray-600"><span class="font-medium">Prix Sortie Réelle :</span>
                    {{ $signal->PrixSortieReelle }}</div>
                <div class="text-gray-600"><span class="font-medium">Take Profit :</span> {{ $signal->TakeProfit }}</div>
                <div class="text-gray-600"><span class="font-medium">Stop Loss :</span> {{ $signal->StopLoss }}</div>
                <div class="text-gray-600"><span class="font-medium">Direction :</span> {{ $signal->Direction }}</div>
                <div class="text-gray-600"><span class="font-medium">Résultat :</span> {{ $signal->Resultat }}</div>
                <div class="text-gray-600"><span class="font-medium">Pips :</span> {{ $signal->Pips }}</div>
                <div class="text-gray-600"><span class="font-medium">Confiance :</span> {{ $signal->Confiance }}</div>
                <div class="text-gray-600"><span class="font-medium">Commentaire :</span> {{ $signal->Commentaire }}</div>
                <div class="text-gray-600"><span class="font-medium">Status :</span> {{ $signal->Status }}</div>
            </div>
            <div class="flex gap-2 mt-6">
                <a href="{{ route('signals.edit', $signal) }}"
                    class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition">Modifier</a>
                <form action="{{ route('signals.destroy', $signal) }}" method="POST"
                    onsubmit="return confirm('Supprimer ce signal ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">Supprimer</button>
                </form>
                <a href="{{ route('signals.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Retour</a>
            </div>
        </div>
    </div>
@endsection
