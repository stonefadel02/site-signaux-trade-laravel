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
    <a href="{{ route('profile.edit') }}"
        class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
        <i class="ti ti-users me-2"></i> Utilisateurs
    </a>
    <div class="flex-1"></div>
    <hr class="my-2">
    <a href="{{ route('profile.edit') }}"
        class="flex items-center px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
        <i class="ti ti-user me-2"></i> Paramètre du compte
    </a>
</nav>
