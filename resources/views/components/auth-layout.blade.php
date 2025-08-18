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
                                         <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none">
  <defs>
    <linearGradient id="candleGradient" x1="0" y1="0" x2="0" y2="24" gradientUnits="userSpaceOnUse"> <stop stop-color="#FFB067"/><stop offset="1" stop-color="#F23D55"/> </linearGradient>
  </defs>
  <rect width="24" height="24" rx="6" fill="#0E0F12FF"/>
  <path d="M6 3a1 1 0 0 1 .993.883l.007.117v1a2 2 0 0 1 1.995 1.85l.005.15v3a2 2 0 0 1-1.85 1.995l-.15.005v8a1 1 0 0 1-1.993.117l-.007-.117v-8a2 2 0 0 1-1.995-1.85l-.005-.15v-3a2 2 0 0 1 1.85-1.995l.15-.005v-1a1 1 0 0 1 1-1z" fill="url(#candleGradient)" />
  <path d="M12 3a1 1 0 0 1 .993.883l.007.117v9a2 2 0 0 1 1.995 1.85l.005.15v3a2 2 0 0 1-1.85 1.995l-.15.005a1 1 0 0 1-1.993.117l-.007-.117l-.15-.005a2 2 0 0 1-1.844-1.838l-.006-.157v-3a2 2 0 0 1 1.85-1.995l.15-.005v-9a1 1 0 0 1 1-1z" fill="url(#candleGradient)" />
  <path d="M18 3a1 1 0 0 1 .993.883l.007.117v1a2 2 0 0 1 1.995 1.85l.005.15v3a2 2 0 0 1-1.85 1.995l-.15.005v8a1 1 0 0 1-1.993.117l-.007-.117v-8a2 2 0 0 1-1.995-1.85l-.005-.15v-3a2 2 0 0 1 1.85-1.995l.15-.005v-1a1 1 0 0 1 1-1z" fill="url(#candleGradient)" />

</svg>


                                    @break

                                    @case('icons.shield-check')
                                       <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <rect width="24" height="24" rx="6" fill="#0060FF"/>
  <path d="M17 7L15 9L12 6L9 9L7 7" stroke="url(#grad1)" stroke-width="2" stroke-linejoin="round"/>
  <path d="M7 17H17M17 17V10" stroke="url(#grad1)" stroke-width="2" stroke-linejoin="round"/>
  <defs>
    <linearGradient id="grad1" x1="7" y1="7" x2="17" y2="17" gradientUnits="userSpaceOnUse">
      <stop stop-color="#FF5329"/>
      <stop offset="1" stop-color="#FF5F2A"/>
    </linearGradient>
  </defs>
</svg>

                                    @break

                                    
                                    @case('icons.gem')
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <rect width="24" height="24" rx="4" fill="#0047B3"/>
  <path d="M10 9H14V13H10V9Z" fill="#0080FF"/>
  <path d="M9 10L15 10" stroke="#0080FF" stroke-width="2" stroke-linecap="round"/>
  <line x1="3" y1="20" x2="21" y2="20" stroke="#0080FF" stroke-width="2" stroke-dasharray="3 4"/>
</svg>

                                    @break

                                    @case('icons.globe')
                                        <svg width="48" height="48" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
  <path d="M7 19H17C18.1046 19 19 18.1046 19 17V7C19 5.89543 18.1046 5 17 5H7C5.89543 5 5 5.89543 5 7V17C5 18.1046 5.89543 19 7 19Z" stroke="url(#grad2)" stroke-width="2" stroke-linejoin="round"/>
  <path d="M11 13H13" stroke="url(#grad2)" stroke-width="2" stroke-linecap="round"/>
  <path d="M9 11L15 11" stroke="url(#grad2)" stroke-width="2" stroke-linecap="round"/>
  <defs>
    <linearGradient id="grad2" x1="5" y1="5" x2="19" y2="19" gradientUnits="userSpaceOnUse">
      <stop stop-color="#FF56DE"/>
      <stop offset="1" stop-color="#8312E1"/>
    </linearGradient>
  </defs>
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
