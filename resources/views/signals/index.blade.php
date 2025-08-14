@extends('layouts.app')

@section('pageTitle', 'Signaux')

@section('content')
    <div class="max-w-7xl mx-auto py-6 ">
        <div class="flex items-center justify-between mb-6">
            <div class="">
                <span>Liste des Signaux</span>
            </div>
            <a href="{{ route('signals.create') }}"
                class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">
                <i class="ti ti-plus mr-2"></i> Nouveau signal
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-200">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-200">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white rounded-lg shadow p-3 pt-5">
            <div class="overflow-x-auto rounded-lg shadow-none border">
                <table class="min-w-full bg-white divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Session</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date/Heure Emission</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actifs</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Direction</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Résultat</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($signals as $signal)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->user_id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->session_id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->DateHeureEmission }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->Actifs }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->Direction }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->Resultat }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $signal->Status }}</td>
                                <td class="px-4 py-3 flex gap-2">
                                    <a href="{{ route('signals.show', $signal) }}"
                                        class="px-2 py-1 bg-blue-100 text-blue-800 rounded hover:bg-blue-200 transition text-xs">Voir</a>
                                    <a href="{{ route('signals.edit', $signal) }}"
                                        class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-xs">Editer</a>
                                    <form action="{{ route('signals.destroy', $signal) }}" method="POST"
                                        onsubmit="return confirm('Supprimer ce signal ?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition text-xs">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-3 text-center text-gray-400">Aucun signal trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
