@extends('layouts.app')
@section('pageTitle', 'Gestion des rôles')
@section('content')
    <div class="max-w-7xl mx-auto mt-8 bg-white shadow rounded p-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Rôles de l'utilisateur : <span class="text-blue-600">{{ $user->name }}</span>
            </h1>
            <a href="{{ route('users.index') }}" class="px-3 py-1 text-sm rounded bg-gray-200 hover:bg-gray-300">Retour</a>
        </div>

        @includeWhen(session('success') || session('error'), 'layouts.partials.alert')

        <form action="{{ route('users.roles.update', $user) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid md:grid-cols-2 gap-4">
                @foreach ($roles as $role)
                    <label class="flex items-start gap-2 p-3 border rounded hover:bg-gray-50 cursor-pointer">
                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" class="mt-1"
                            {{ in_array($role->name, old('roles', $userRoleNames)) ? 'checked' : '' }}>
                        <div>
                            <span class="font-medium text-gray-800">{{ $role->name }}</span>
                            @if ($role->guard_name !== 'web')
                                <span class="ml-2 text-xs text-gray-400">({{ $role->guard_name }})</span>
                            @endif
                        </div>
                    </label>
                @endforeach
            </div>
            @error('roles.*')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
            <div class="flex items-center gap-2 pt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Enregistrer</button>
                <a href="{{ route('users.roles.edit', $user) }}"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Réinitialiser</a>
            </div>
        </form>
    </div>
@endsection
