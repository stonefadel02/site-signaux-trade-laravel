{{-- resources/views/support.blade.php --}}
<x-app-layout>
    {{-- On passe le titre de la page au layout via un "slot" nommé "header" --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Support & Assistance') }}
        </h2>
    </x-slot>

    {{-- Le contenu principal de la page commence ici --}}
    <div class="space-y-8 py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Section Support / Assistance --}}
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                
                {{-- Colonne de gauche : Contact --}}
                <div class="rounded-lg bg-white p-10 shadow-sm lg:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-800">Support / Assistance</h3>
                    <p class="mt-1 text-sm text-gray-500">Contactez-nous directement via :</p>
                    
                    <div class="mt-16 mb-10 grid grid-cols-1 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="flex items-center gap-4">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-[#0554F1]">
                                <i class="fa-solid fa-beat-fade fa-envelope text-white"></i>
                            </div>
                            <span class="text-sm text-gray-700">contact@triple7signalsperday.com</span>
                        </div>
                        <div class="flex items-center ml-11 gap-4">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-[#0554F1]">
                                <i class="fa-solid fa-beat-fade fa-phone text-white"></i>
                            </div>
                            <span class="text-sm  text-gray-700">+229 01 97 44 29 83</span>
                        </div>
                        <div class="flex items-center  gap-4">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-[#0554F1]">
                                <i class="fa-solid fa-beat-fade fa-map-pin text-white"></i>
                            </div>
                            <span class="text-sm text-gray-700">Cotonou, Bénin</span>
                        </div>
                    </div>
                </div>

                {{-- Colonne de droite : Image du casque --}}
                <div class="flex items-center justify-center rounded-lg bg-white p-6 shadow-sm">
                    <img src="{{ asset('headphones2.png') }}" alt="Support Headset" class="h-64 w-auto">
                </div>
            </div>

            {{-- Section FAQs --}}
            <div class="mt-8 rounded-lg bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800">FAQs</h3>
                <p class="mt-1 text-sm text-gray-500">Nos questions fréquentes</p>
                <div class="mt-4">
                    <x-faq-support />
                </div>
            </div>

        </div>
    </div>
</x-app-layout>