{{-- resources/views/access_codes/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Codes d\'accès') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <div></div>
                <a href="{{ route('access-codes.create') }}"
                    class="inline-flex items-center rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700">
                    <i class="fa-solid fa-plus mr-2"></i> Générer un code
                </a>
            </div>

            {{-- Notifications de succès/erreur --}}
            @if (session('success'))
                <div class="mb-4 rounded border border-green-200 bg-green-100 p-4 text-green-800">{{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 rounded border border-red-200 bg-red-100 p-4 text-red-800">{{ session('error') }}</div>
            @endif

            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Plan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Validité</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Expiration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Utilisateur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Actions</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($accessCodes as $code)
                            <tr>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $code->Code }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{ $code->plan->nom ?? 'N/A' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $code->DureeEnJours }}
                                    jours</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{ $code->ExpireLe ? $code->ExpireLe->format('d/m/Y') : 'N/A' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div x-data="{ open: false }" class="relative inline-block text-left">
                                        <div>
                                            <button @click="open = !open" type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-cyan-500">
                                                Actions
                                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
                                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                                            style="display: none;">
                                            <div class="py-1" role="none">
                                                <a href="{{ route('access-codes.show', $code) }}"
                                                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <i class="fa-solid fa-eye mr-2"></i> Voir
                                                </a>
                                                <a href="{{ route('access-codes.edit', $code) }}"
                                                    class="flex items-center w-full px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-100">
                                                    <i class="fa-solid fa-pencil mr-2"></i> Modifier
                                                </a>
                                                <form action="{{ route('access-codes.destroy', $code) }}" method="POST"
                                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce code ?')"
                                                    class="w-full">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-red-100 text-left">
                                                        <i class="fa-solid fa-trash mr-2"></i> Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Aucun code d'accès trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $accessCodes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>