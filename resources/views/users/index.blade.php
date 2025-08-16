@extends('layouts.app')
@section('pageTitle', 'Utilisateurs')
@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6  bg-white rounded shadow p-6 mt-6">

        <form method="GET" action="{{ route('users.index') }}" class="mb-6 flex">
            <input type="text" name="search" value="{{ $search }}" placeholder="Rechercher par nom ou email..."
                class="flex-1 px-4 py-2 border rounded-l focus:outline-none" />
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r hover:bg-blue-700">Rechercher</button>
        </form>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Nom</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Date d'inscription</th>
                        <th class="px-4 py-2 text-left">Dernier abonnement</th>
                        <th>Rôles</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b">
                            <td class="px-4 py-2">
                                <div class="">
                                    <h6>{{ $user->name }}</h6>
                                    @foreach ($user->roles as $role)
                                        <span class="text-sm bg-gray-200 rounded-lg p-1 px-2">{{ $role->name }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $user->getLastSouscription()?->toString() }}</td>
                            <td class="px-4 py-2 space-x-3 text-sm">
                                <a href="{{ route('users.roles.edit', $user) }}"
                                    class="text-indigo-600 hover:underline">Gérer rôles</a>
                                @role('Super-admin')
                                    <a href="{{ route('sudo-login', $user->id) }}"
                                        class="text-blue-600 hover:underline">Imiter</a>
                                @endrole
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-500 py-8">Aucun utilisateur trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
@endsection
