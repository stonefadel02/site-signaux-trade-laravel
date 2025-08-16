<div>
    <div class="bg-white w-full rounded-lg p-4">
        <div class="flex items-center   justify-between mb-4">
            <div class="">
                <h6 class="text-lg font-semibold mb-0">Mes sessions</h6>
                <p class="mb-2 text-sm text-gray-700">Liste des sessions</p>
            </div>
            <div class="">
                <a href="{{ route('session-signals.create') }}"
                    class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    <i class="ti ti-plus mr-2"></i> Nouvelle session
                </a>
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200 mt-4 border rounded-lg">
            <thead class="bg-gray-50">
                <tr>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heure
                        Début</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heure
                        Fin
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($datas as $data)
                    <tr>
                        <td class="px-4 py-3">{{ $data->id }}</td>

                        <td class="px-4 py-3  ">{{ $data->id }}</td>
                        <td class="px-4 py-3  font-semibold ">{{ $data->Titre }}</td>
                        <td class="px-4 py-3  ">{{ $data->HeureDebut }}
                        </td>
                        <td class="px-4 py-3 ">{{ $data->HeureFin }}</td>
                        <td class="px-4 py-3 flex gap-2">
                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                <div>
                                    <button @click="open = !open" type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 z-40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                                        id="options-menu" aria-haspopup="true" x-bind:aria-expanded="open.toString()">
                                        Actions
                                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
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
                                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg  z-50 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                    <div class="py-1" role="none">

                                        <a href="{{ route('session-signals.edit', $data) }}"
                                            class="inline-flex items-center px-4 py-2 text-sm text-yellow-800 hover:bg-yellow-100 w-full">
                                            <i class="ti ti-edit mr-2"></i> Modifier
                                        </a>
                                        <form action="{{ route('session-signals.destroy', $data) }}" method="POST"
                                            onsubmit="return confirm('Supprimer cette session ?')" class="w-full">
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
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500 font-bold">Aucune
                            data
                            trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
