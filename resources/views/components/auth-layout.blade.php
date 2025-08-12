<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-g">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Authentification - {{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-gray-900 sm:py-30">
        {{-- Image de fond --}}
        <img src="{{ asset('bg.png') }}" alt="Background" class="absolute inset-0 z-0 h-full w-full object-cover opacity-20">

        <div class="relative z-10 grid w-full max-w-6xl grid-cols-1 rounded-xl bg-white shadow-2xl md:grid-cols-2">

            <div class="p-8 sm:p-12">
                {{ $slot }}
            </div>

            <div class="hidden rounded-r-xl bg-[#132954] p-12 py-30 text-white md:block">
                <h2 class="text-[40px] font-bold leading-tight">
                    VOS MEILLEURS SIGNAUX DE TRADING EN TEMPS RÉEL.
                </h2>
                @php
                    $features = [
                        ['name' => '30 signaux par jour', 'icon' => 'icons.repeat'], // Les icônes seront des composants Blade
                        ['name' => 'Signaux de trading fiables', 'icon' => 'icons.shield-check'],
                        ['name' => 'Flexibilité d’abonnement', 'icon' => 'icons.gem'],
                        ['name' => 'Accessibilité internationale', 'icon' => 'icons.globe'],
                    ];
                @endphp
                <ul role="list" class="mt-8 space-y-6">
                    @foreach ($features as $feature)
                        <li class="flex items-center gap-4">
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-lg bg-white/10">
                                <svg class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"></svg>
                            </div>
                            <span class="text-[18px]">{{ $feature['name'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>
</html>