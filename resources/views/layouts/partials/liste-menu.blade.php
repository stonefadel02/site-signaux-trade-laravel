<div class="shrink-0 flex justify-center mb-4">
    <a href="{{ route('dashboard') }}">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
    </a>
</div>
<img src="{{ asset('assets/header_sidebar.png') }}" class="w-full mb-4" alt="">
<nav class="space-y-2 flex-1 flex flex-col">
    <a href="{{ route('dashboard') }}"
        class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
        <i class="ti ti-layout-dashboard me-2"></i> Dashboard
    </a>
    <a href="{{ route('signaux') }}"
        class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
        <i class="ti ti-activity me-2"></i> Signaux
    </a>
    <a href="{{ route('mon-abonnement') }}"
        class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
        <i class="ti ti-wallet me-2"></i>Mon abonnement
    </a>
    @role('Super-admin')
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="flex items-center w-full px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium focus:outline-none">
                <i class="ti ti-shield me-2"></i> Administration
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-auto transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="mt-1 space-y-1 pl-2">
                <a href="{{ route('users.index') }}"
                    class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
                    <i class="ti ti-users me-2"></i> Utilisateurs
                </a>

                <a href="{{ route('plans.index') }}"
                    class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
                    <i class="ti ti-calendar-clock me-2"></i> Plans
                </a>

                {{-- <a href="{{ route('souscription.create') }}"
                class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
                <i class="ti ti-wallet me-2"></i> Souscriptions
            </a> --}}
                <a href="{{ route('parametrage-signaux') }}"
                    class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
                    <i class="ti ti-calendar-clock me-2"></i> Parametrage Signaux
                </a>
                <a href="{{ route('access-codes.index') }}"
                    class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
                    <i class="ti ti-activity me-2"></i> Code d'Access
                </a>

                <a href="{{ route('signals.index') }}"
                    class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
                    <i class="ti ti-activity me-2"></i> Signals
                </a>
            </div>
        </div>
    @endrole

    <div class="flex-1"></div>
    <hr class="my-2">
    <a href="{{ route('profile.edit') }}"
        class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
        <i class="ti ti-user me-2"></i> Paramètre du compte
    </a>
    <a href="{{ route('support') }}"
        class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
        <i class="ti ti-headset me-2"></i> Support
    </a>
</nav>
