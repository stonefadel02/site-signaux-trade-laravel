{{-- resources/views/components/footer.blade.php --}}

@php
$usefulLinks = [
 ['name' => 'Accueil', 'href' => '#accueil'],
    ['name' => 'Comment ça marche ?', 'href' => '#comment-ca-marche'],
    ['name' => 'Accéder aux Signaux', 'href' => '#tarifs'], 
    ['name' => 'FAQ', 'href' => '#faq'],
];

$legalLinks = [
    ['name' => 'À propos de nous', 'href' => '#'],
    ['name' => 'Conditions Générales de Vente', 'href' => '#'],
    ['name' => 'Politique de Confidentialité', 'href' => '#'],
    ['name' => 'Politique de Remboursement', 'href' => '#'],
    ['name' => 'Clause de Non-responsabilité', 'href' => '#'],
];

$socialLinks = [
    ['name' => 'Facebook', 'href' => '#', 'icon_class' => 'fa-brands fa-bounce fa-facebook-f '],
    ['name' => 'Instagram', 'href' => '#', 'icon_class' => 'fa-brands fa-bounce fa-instagram'],
    ['name' => 'Twitter', 'href' => '#', 'icon_class' => 'fa-brands fa-bounce fa-twitter'],
    ['name' => 'Youtube', 'href' => '#', 'icon_class' => 'fa-brands fa-bounce fa-youtube'],
];
@endphp

<footer class="bg-[#0C0D0F] text-white">
    <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24 lg:px-8">
        {{-- Partie supérieure : Logo, liens et contact --}}
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-4 lg:gap-8">
            {{-- Colonne du logo --}}
            <div class="space-y-4 text-left">
                <a href="/">
                    <img
                        src="{{ asset('logo2.png') }}"
                        alt="Triple1SignalsPerDay Logo"
                        class="h-20 w-auto rounded-lg bg-white p-2"
                    />
                </a>
                <p class="mr-10 mt-4 text-left text-[13px] text-white">
                    Notre source de signaux de trading experts et fiables. Prenez le contrôle de vos profits.
                </p>
            </div>

            {{-- Colonnes des liens --}}
            <div class="grid grid-cols-2 gap-8 md:grid-cols-3 lg:col-span-3">
                <div>
                    <h3 class="font-semibold">Liens Utiles</h3>
                    <ul role="list" class="mt-4 space-y-5">
                        @foreach ($usefulLinks as $item)
                            <li>
                                <a href="{{ $item['href'] }}" class="text-sm text-white hover:text-gray-300">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold">Informations Légales</h3>
                    <ul role="list" class="mt-4 space-y-5">
                        @foreach ($legalLinks as $item)
                            <li>
                                <a href="{{ $item['href'] }}" class="text-sm text-white hover:text-gray-300">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold">Contact</h3>
                    <ul role="list" class="mt-4 space-y-5">
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-beat-fade fa-phone h-5 w-5 flex-shrink-0 text-cyan-400"></i>
                            <span class="text-sm text-white">+229 01 97 44 29 83</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-beat-fade fa-envelope h-5 w-5 flex-shrink-0 text-cyan-400"></i>
                            <span class="text-sm text-white">contact@triple7signalsperday.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-beat-fade fa-map-pin h-5 w-5 flex-shrink-0 text-cyan-400"></i>
                            <span class="text-sm text-white">Cotonou, Bénin</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Partie du milieu : Newsletter --}}
        <div class="mx-auto mt-16 w-4/6 pt-12">
            <form class="flex flex-col gap-4 sm:flex-row">
                @csrf
                <label for="email-address" class="sr-only">Votre email</label>
                <input
                    id="email-address"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required
                    class="flex-auto rounded-md bg-[#12141D] px-4 py-6 text-white placeholder:text-gray-400 focus:outline-none focus:ring-0 sm:text-sm"
                    placeholder="Votre email pour souscrire à notre newsletter"
                />
                <button
                    type="submit"
                    class="flex-none rounded-md bg-[#00AFFF] px-8 py-6 text-sm font-semibold text-white shadow-sm hover:bg-cyan-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-500 sm:ml-[-30px]"
                >
                    Souscrire
                </button>
            </form>
        </div>

        {{-- Partie inférieure : Copyright et réseaux sociaux --}}
        <div class="mt-12 flex flex-col-reverse items-center justify-between gap-8 border-t border-white/10 pt-8 sm:flex-row">
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} - All Rights Reserved | Coded by HOMDI
            </p>
            <div class="flex space-x-6">
                @foreach ($socialLinks as $item)
                    <a href="{{ $item['href'] }}" class="text-gray-400 hover:text-white">
                        <span class="sr-only">{{ $item['name'] }}</span>
                        <i class="{{ $item['icon_class'] }} h-6 w-6" aria-hidden="true"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>