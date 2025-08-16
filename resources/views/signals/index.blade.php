@extends('layouts.app')

@section('pageTitle', 'Signaux')

@section('content')
    @php
        $activeTab = 'liste';
    @endphp
    <div class="max-w-7xl mx-auto py-6 ">

        <div x-data="{ tab: '{{ $activeTab }}' }" class="mb-8 mt-0">
            <div class="flex space-x-4 border-b border-gray-200">
                <button @click="tab = 'liste'"
                    :class="tab === 'liste' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                    class="flex items-center px-4 py-2 focus:outline-none transition">
                    <i class="ti ti-history mr-2"></i>
                    Tous les signaux
                </button>
                <button @click="tab = 'resultat'"
                    :class="tab === 'resultat' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                    class="flex items-center px-4 py-2 focus:outline-none transition">
                    <i class="ti ti-key mr-2"></i>
                    Les signaux en attente de résultat
                </button>
                <a href="{{ route('parametrage-signaux') }}"
                    :class="tab === 'parametrage' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                    class="flex items-center px-4 py-2 focus:outline-none transition">
                    <i class="ti ti-key mr-2"></i>
                    Parametrage
                </a>

            </div>
            <div class="mt-6">
                <div x-show="tab === 'liste'">
                    <div class="bg-white rounded-lg shadow p-3 pt-5">
                        <div class="flex items-center justify-between mb-6">
                            <div class="">

                            </div>
                            <div class="flex items-center gap-2">
                                <div x-data="{ openImportModal: false }">
                                    <!-- Bouton pour ouvrir le modal -->
                                    <a href="javascript:void(0)" @click="openImportModal = true"
                                        class="inline-flex items-center px-3 py-1 bg-white text-gray-700 rounded-lg shadow hover:bg-blue-200 transition">
                                        <i class="ti ti-arrow-bar-up mr-2"></i> Importer
                                    </a>

                                    <!-- Inclure le modal -->
                                    @include('signals.modalimporter')
                                </div>
                                <a href="{{ route('signals-export') }}"
                                    class="inline-flex items-center px-3 py-1 bg-white text-gray-700 rounded-lg shadow hover:bg-blue-200 transition">
                                    <i class="ti ti-download mr-2"></i> Exporter
                                </a>

                                <a href="{{ route('signals.create') }}"
                                    class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">
                                    <i class="ti ti-plus mr-2"></i> Nouveau signal
                                </a>
                            </div>
                        </div>
                        <div class="overflow-x-auto rounded-lg shadow-none border">
                            <table class="min-w-full bg-white divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>

                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Session</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date/Heure Emission</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actifs</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Direction</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Résultat</th>

                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($signals as $signal)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->id }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->session->Titre }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->DateHeureEmission }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->actif->toString() }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->Direction }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->Resultat }}</td>

                                            <td class="px-4 py-3 flex gap-2">
                                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                                    <div>
                                                        <button @click="open = !open" type="button"
                                                            class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 z-40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                                                            id="options-menu" aria-haspopup="true"
                                                            x-bind:aria-expanded="open.toString()">
                                                            Actions
                                                            <svg class="-mr-1 ml-2 h-5 w-5"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div x-show="open" @click.away="open = false"
                                                        x-transition:enter="transition ease-out duration-100"
                                                        x-transition:enter-start="transform opacity-0 scale-95"
                                                        x-transition:enter-end="transform opacity-100 scale-100"
                                                        x-transition:leave="transition ease-in duration-75"
                                                        x-transition:leave-start="transform opacity-100 scale-100"
                                                        x-transition:leave-end="transform opacity-0 scale-95"
                                                        class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg  z-50 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                        role="menu" aria-orientation="vertical"
                                                        aria-labelledby="options-menu">
                                                        <div class="py-1" role="none">
                                                            <a href="{{ route('signals.show', $signal->id) }}"
                                                                class="inline-flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                                                <i class="ti ti-eye mr-2"></i> Voir
                                                            </a>
                                                            <a href="{{ route('signals.edit', $signal->id) }}"
                                                                class="inline-flex items-center px-4 py-2 text-sm text-yellow-800 hover:bg-yellow-100 w-full">
                                                                <i class="ti ti-edit mr-2"></i> Modifier
                                                            </a>
                                                            <form action="{{ route('signals.destroy', $signal->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Supprimer cette session ?')"
                                                                class="w-full">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="inline-flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-100 w-full text-left">
                                                                    <i class="ti ti-trash mr-2"></i> Supprimer
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="px-4 py-3 text-center text-gray-400">Aucun signal
                                                trouvé.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div x-show="tab === 'resultat'">

                </div>

            </div>
        </div>

    </div>
@endsection
