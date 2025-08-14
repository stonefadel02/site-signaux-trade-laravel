{{-- resources/views/components/dashboard-layout.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name', 'Laravel') }}</title>

    {{-- CDN Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="flex h-screen bg-gray-100">

        {{-- Appel de la Sidebar --}}
        <x-sidebar />

        {{-- Contenu Principal --}}
        <div class="flex-1 flex flex-col">
            <header class="flex items-center justify-end bg-white p-4 shadow-md">
                <div class="flex items-center gap-6">
                    <button class="relative rounded-full p-2 text-gray-600 hover:bg-gray-200">
                        <i class="fa-solid fa-bell text-xl"></i>
                        <span class="absolute right-2 top-2 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('testimonials/alex.png') }}" alt="Avatar" class="h-10 w-10 rounded-full object-cover"/>
                        <div class="text-right">
                            <p class="font-semibold text-gray-800">Alain Dossou</p>
                            <p class="text-xs text-gray-500">Abonné</p>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Contenu de la page spécifique (ex: support) --}}
            <main class="flex-1 overflow-y-auto p-8">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>
</html>