{{-- resources/views/support.blade.php --}}
<x-dashboard-layout>
    <div class="space-y-8">

        {{-- Section Support / Assistance --}}
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            {{-- Colonne de gauche : Contact --}}
            <div class="rounded-lg bg-white p-6 shadow lg:col-span-2">
                <h3 class="text-lg font-semibold text-gray-800">Support / Assistance</h3>
                <p class="mt-1 text-sm text-gray-500">Contactez-nous directement via :</p>
                <div class="mt-6 space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                            <i class="fa-solid fa-envelope text-blue-600"></i>
                        </div>
                        <span class="text-gray-700">Example@gmail.com</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                            <i class="fa-solid fa-phone text-blue-600"></i>
                        </div>
                        <span class="text-gray-700">+00 00 000 0000</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                            <i class="fa-solid fa-map-pin text-blue-600"></i>
                        </div>
                        <span class="text-gray-700">Cotonou, Bénin</span>
                    </div>
                </div>
            </div>

            {{-- Colonne de droite : Image du casque --}}
            <div class="flex  items-center  justify-center rounded-lg bg-white p-6 shadow">
                <img src="{{ asset('headphones.png') }}" alt="Support Headset" class="h-36   w-auto">
            </div>
        </div>

        {{-- Section FAQs --}}
        <div class="rounded-lg bg-white p-6 shadow">
            <h3 class="text-lg font-semibold text-gray-800">FAQs</h3>
            <p class="mt-1 text-sm text-gray-500">Nos questions fréquentes</p>
            <div class="mt-4">
                {{-- Ici, vous pouvez intégrer votre composant FAQ --}}
                {{-- Pour cet exemple, je mets une version simplifiée --}}
                <x-faq-section-minimal />
            </div>
        </div>

    </div>
</x-dashboard-layout>