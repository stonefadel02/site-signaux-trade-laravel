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
                <h3 class="text-[30px] font-bold leading-tight">
                    VOS MEILLEURS SIGNAUX DE TRADING EN TEMPS RÉEL.
                </h3>
                @php
                    $features = [
                        ['name' => '30 signaux par jour', 'icon' => 'icons.repeat'], 
                        ['name' => 'Signaux de trading fiables', 'icon' => 'icons.shield-check'],
                        ['name' => 'Flexibilité d’abonnement', 'icon' => 'icons.gem'],
                        ['name' => 'Accessibilité internationale', 'icon' => 'icons.globe'],
                    ];
                @endphp
                <ul role="list" class="mt-8 space-y-6">
                    @foreach ($features as $feature)
                        <li class="flex items-center gap-4">
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-lg bg-white/10">
                                @switch($feature['icon'])
                                    @case('icons.repeat')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 11l4-4m0 0l-4-4m4 4H7a4 4 0 1 0 0 8h1.5M21 7h1.5a4 4 0 1 1 0 8H21m0-8v8" />
                                        </svg>
                                    @break

                                    @case('icons.shield-check')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m1 2a8.1 8.1 0 0 1-4 1.5C8 18 5 14 5 10a7 7 0 0 1 7-7h3a7 7 0 0 1 7 7c0 4-3 8-6 8a7 7 0 0 1-4-1.5M9 10l-1 1 4 4 1-1" />
                                        </svg>
                                    @break

                                    @case('icons.gem')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2L5 12l7 10 7-10-7-10zm0 0v20" />
                                        </svg>
                                    @break

                                    @case('icons.globe')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zM12 12l2 2-2 2m0-4l-2 2 2 2" />
                                        </svg>
                                    @break
                                @endswitch
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
