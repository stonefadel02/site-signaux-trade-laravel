{{-- resources/views/access_codes/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Détails du Code : {{ $accessCode->Code }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-8 shadow-sm sm:rounded-lg">
                <div class="mb-6">
                    <p class="text-sm text-gray-500">Code</p>
                    <p class="text-lg font-bold text-gray-800">{{ $accessCode->Code }}</p>
                </div>
                <div class="mb-6">
                    <p class="text-sm text-gray-500">Plan Associé</p>
                    <p class="text-lg text-gray-800">{{ $accessCode->plan->nom ?? 'N/A' }}</p>
                </div>
                <div class="mb-6">
                    <p class="text-sm text-gray-500">Validité</p>
                    <p class="text-lg text-gray-800">{{ $accessCode->DureeEnJours }} jours</p>
                </div>
                <div class="mb-6">
                    <p class="text-sm text-gray-500">Expire le</p>
                    <p class="text-lg text-gray-800">{{ $accessCode->ExpireLe ? $accessCode->ExpireLe->format('d F Y') : 'Non défini' }}</p>
                </div>

                <div class="mt-8 flex items-center gap-4">
                    <a href="{{ route('access-codes.index') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">Retour</a>
                    <a href="{{ route('access-codes.edit', $accessCode) }}" class="rounded-md border border-transparent bg-yellow-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-yellow-600">Modifier</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>