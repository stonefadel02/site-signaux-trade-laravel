{{-- resources/views/components/public-navbar.blade.php --}}
<header x-data="{ isOpen: false }" class="fixed top-0 z-50 w-full bg-white shadow-sm">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 py-12 md:px-6 lg:px-8">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center space-x-2">
            <img src="{{ asset('logo.png') }}" alt="Triple1Signals Logo" class="h-12 w-auto">
        </a>

        {{-- Navigation Desktop --}}
        <nav class="hidden items-center space-x-6 md:flex">
            <a href="{{ url('/') }}" class="text-sm text-gray-700 hover:text-blue-600">Accueil</a>
            <a href="#fonctionnalites" class="text-sm text-gray-700 hover:text-blue-600">À propos</a>
            <a href="#tarifs" class="text-sm text-gray-700 hover:text-blue-600">Tarifs</a>
            <a href="#faq" class="text-sm text-gray-700 hover:text-blue-600">FAQ</a>
            <a href="#contact" class="text-sm text-gray-700 hover:text-blue-600">Contact</a>

            @auth
                {{-- Si l'utilisateur est connecté --}}
                <a href="{{ route('dashboard') }}"
                    class="rounded-[5px] bg-gray-800 px-4 py-2 text-sm text-white transition hover:bg-gray-700">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="cursor-pointer rounded-[5px] bg-gray-200 px-4 py-2 text-sm text-gray-800 transition hover:bg-gray-300">
                        Déconnexion
                    </button>
                </form>
            @else
                {{-- Si l'utilisateur n'est pas connecté --}}
                <a href="{{ route('login') }}"
                    class="cursor-pointer rounded-[5px] bg-[#00AFFF] px-4 py-2 text-sm text-white transition hover:bg-blue-600">
                    Connexion
                </a>
            @endauth
        </nav>

        {{-- Bouton burger pour mobile --}}
        <div class="md:hidden">
            <button @click="isOpen = !isOpen" class="focus:outline-none">
                <i class="fa-solid" :class="isOpen ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>
    </div>

    {{-- Menu Mobile --}}
    <div x-show="isOpen" @click.away="isOpen = false" x-transition class="border-t bg-white md:hidden">
        <div class="space-y-1 px-4 py-4">
            <a href="#accueil" @click="isOpen = false"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600">Accueil</a>
            <a href="#fonctionnalites" @click="isOpen = false"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600">À
                propos</a>
            <a href="#tarifs" @click="isOpen = false"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600">Tarifs</a>
            <a href="#faq" @click="isOpen = false"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600">FAQ</a>
            <a href="#contact" @click="isOpen = false"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600">Contact</a>

            <div class="border-t border-gray-200 pt-4 mt-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block rounded-md bg-gray-800 px-3 py-2 text-center text-base font-medium text-white">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit"
                            class="w-full rounded-md bg-gray-200 px-3 py-2 text-base font-medium text-gray-800">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block rounded-md bg-[#00AFFF] px-3 py-2 text-center text-base font-medium text-white">
                        Connexion
                    </a>
                @endauth
            </div>
        </div>
    </div>

</header>