@extends('layouts.app')

@section('pageTitle', 'Accès Interdit')

@section('content')

    <div id="myModal" class="modal fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96 relative">
            <h2 class="text-lg font-semibold mb-4">Titre du modal</h2>
            <p class="text-gray-700 mb-4">Ce modal est géré comme Bootstrap mais en Tailwind.</p>
            <div class="flex justify-end gap-2">
                <button data-tw-dismiss="modal" class="px-3 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Fermer
                </button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Valider
                </button>
            </div>
        </div>
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" data-tw-toggle="modal"
        data-tw-target="#myModal">
        Ouvrir le modal
    </button>

    <div class="max-w-7xl mx-auto  mt-10 p-4 bg-white rounded shadow w-full">
        <div class="">

        </div>
        <h1 class="text-xl font-semibold">Aucun abonnement actif</h1>
        <p>Vous ne pouvez pas voir les signaux pour le moment en raison de votre abonnement inactif.</p>
    </div>
@endsection
