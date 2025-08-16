@extends('{{ layout }}')

@section('pageTitle', '{{ modelTitle }}')

@section('content')
    <div class="max-w-lg mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-xl font-bold mb-6 text-gray-800">Détail du {{ modelTitle }}</h1>
            <div class="mb-4">

                <div class="text-gray-600 mt-2">
                    <span class="font-medium">Nom :</span>
                    {{ $typeMarch->Nom }}
                </div>
                <div class="text-gray-600 mt-2">
                    <span class="font-medium">Description :</span>
                    {{ $typeMarch->Description }}
                </div>

            </div>
            <div class="flex gap-2 mt-6">
                <a href="{{ route('type-marches.edit', $typeMarch) }}"
                    class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition">Modifier</a>
                <form action="{{ route('type-marches.destroy', $typeMarch) }}" method="POST"
                    onsubmit="return confirm('Supprimer cet élément ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">Supprimer</button>
                </form>
                <a href="{{ route('parametrage-signaux', ['tab' => 'marche']) }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Retour</a>
            </div>
        </div>
    </div>
@endsection
