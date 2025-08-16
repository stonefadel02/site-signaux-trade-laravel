@extends('layouts.app')

@section('pageTitle', 'Détail de l\'Actif')

@section('content')
    <div class="max-w-lg mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-xl font-bold mb-6 text-gray-800">Détail de l'actif {{ $actif->Nom }}</h1>
            <div class="mb-4">

                <div class="text-gray-600 mt-2">
                    <span class="font-medium">Typemarche :</span>
                    {{ $actif->TypeMarche }}
                </div>
                <div class="text-gray-600 mt-2">
                    <span class="font-medium">Symbole :</span>
                    {{ $actif->Symbole }}
                </div>
                <div class="text-gray-600 mt-2">
                    <span class="font-medium">Nom :</span>
                    {{ $actif->Nom }}
                </div>

            </div>
            <div class="flex gap-2 mt-6">
                <a href="{{ route('actifs.edit', $actif) }}"
                    class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition">Modifier</a>
                <form action="{{ route('actifs.destroy', $actif) }}" method="POST"
                    onsubmit="return confirm('Supprimer cet élément ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">Supprimer</button>
                </form>
                <a href="{{ route('parametrage-signaux', ['tab' => 'actifs']) }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Retour</a>
            </div>
        </div>
    </div>
@endsection
