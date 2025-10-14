@extends('layouts.app')
@section('pageTitle', 'Nouveau plan')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-xl font-bold mb-6 text-gray-800">Créer un plan</h1>
            @if ($errors->any())
                <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-200">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('plans.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="Titre" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                    <input type="text" name="Titre"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('Titre') }}" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="Prix" class="block text-sm font-medium text-gray-700 mb-1">Prix</label>
                        <input type="number" step="0.0001" name="Prix"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('Prix') }}" required>
                    </div>
                    <div>
                        <label for="Devise" class="block text-sm font-medium text-gray-700 mb-1">Devise</label>
                        <input type="text" name="Devise"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('Devise') }}" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="DureeEnJours" class="block text-sm font-medium text-gray-700 mb-1">Durée (jours)</label>
                        <input type="number" name="DureeEnJours"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('DureeEnJours') }}" required>
                    </div>
                    <div>
                        <label for="NombreDeSignaux" class="block text-sm font-medium text-gray-700 mb-1">Nombre de
                            signaux</label>
                        <input type="number" name="NombreDeSignaux"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('NombreDeSignaux') }}" required>
                    </div>
                </div>
                <div>
                    <label for="AutresAvantages" class="block text-sm font-medium text-gray-700 mb-1">Autres avantages (un
                        par ligne)</label>
                    <textarea name="AutresAvantages" rows="3"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ex: Support VIP&#10;Accès à la communauté&#10;Webinaires mensuels">{{ old('AutresAvantages') }}</textarea>
                </div>
                <div>
                    <label for="Visibilite" class="block text-sm font-medium text-gray-700 mb-1">Visibilité</label>
                    <select name="Visibilite"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="PUBLIQUE" {{ old('Visibilite') == 'PUBLIQUE' ? 'selected' : '' }}>Publique</option>
                        <option value="PRIVEE" {{ old('Visibilite') == 'PRIVEE' ? 'selected' : '' }}>Privée</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="isPopular" id="isPopular"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        {{ old('isPopular') ? 'checked' : '' }}>
                    <label for="isPopular" class="ml-2 block text-sm text-gray-900">Mettre en avant ce plan</label>
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">Créer</button>
                    <a href="{{ route('plans.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
