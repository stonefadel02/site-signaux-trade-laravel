{{-- resources/views/components/sidebar.blade.php --}}

@php
// Données pour les liens de la sidebar pour une gestion facile
$sidebarLinks = [
    ['name' => 'Dashboard', 'href' => '/dashboard', 'icon' => 'fa-solid fa-beat fa-chart-pie'],
    ['name' => 'Signaux', 'href' => '/signaux', 'icon' => 'fa-solid fa-beat fa-chart-line'],
    ['name' => 'Mon Abonnement', 'href' => '/abonnement', 'icon' => 'fa-solid fa-beat fa-wallet'],
    ['name' => 'Mes paiements', 'href' => '/paiements', 'icon' => 'fa-solid fa-beat fa-receipt'],
    ['name' => 'Mes codes d\'accès', 'href' => '/codes', 'icon' => 'fa-solid fa-beat fa-key'],
];
$bottomLinks = [
    ['name' => 'Paramètre du compte', 'href' => '/parametres', 'icon' => 'fa-solid fa-gear'],
    ['name' => 'Support', 'href' => '/support', 'icon' => 'fa-solid fa-circle-question'],
];
@endphp

<aside class="hidden w-80 flex-col bg-white p-4 shadow-lg sm:flex">
    {{-- Logo --}}
    <div class="mb-8 flex items-center justify-center">
        <a href="/">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-16 w-auto">
        </a>
    </div>

    {{-- Image sous le logo --}}
    <div class="mb-8 py-10 px-4">
        <div class="h-20 rounded-lg bg-cover bg-center" style="background-image: url('{{ asset('sous-logo.png') }}')"></div>
    </div>

    {{-- Navigation principale --}}
    <nav class="flex-1 space-y-3">
        @foreach ($sidebarLinks as $link)
            <a 
                href="{{ url($link['href']) }}" 
                class="flex items-center text-[#8594A8] gap-4 text-[18px] rounded-lg px-4 py-2.5 font-medium transition-colors {{ request()->is(ltrim($link['href'], '/')) ? 'bg-cyan-500 text-white shadow-sm' : 'text-gray-500 hover:bg-gray-100' }}"
            >
                <i class="{{ $link['icon'] }} w-5 text-center"></i>
                <span class=" text-[24px]" >{{ $link['name'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- Navigation du bas --}}
    <div class="mt-auto space-y-3">
        @foreach ($bottomLinks as $link)
            <a 
                href="{{ url($link['href']) }}" 
                class="flex items-center gap-4 rounded-lg px-4 py-2.5 text-sm font-medium transition-colors {{ request()->is(ltrim($link['href'], '/')) ? 'bg-cyan-500 text-white shadow-sm' : 'text-gray-500 hover:bg-gray-100' }}"
            >
                <i class="{{ $link['icon'] }} w-5 text-center"></i>
                <span>{{ $link['name'] }}</span>
            </a>
        @endforeach
    </div>
</aside>