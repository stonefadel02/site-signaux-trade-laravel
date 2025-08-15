{{-- resources/views/components/faq-support.blade.php --}}
@php
$faqs = [
    ['question' => 'Est-il bon de trader avec des signaux ?', 'answer' => 'Absolument ! Lorsque les fournisseurs sont fiables...'],
    ['question' => 'Comparatif signaux de trading : pourquoi nous choisir ?', 'answer' => 'Nous nous démarquons par la transparence...'],
    ['question' => 'Signaux de trading gratuits ou payants ?', 'answer' => 'Les signaux gratuits ne garantissent pas toujours la fiabilité...'],
    ['question' => 'Signaux de trading WhatsApp, Telegram, etc. ?', 'answer' => 'Pour le moment, nos signaux sont disponibles sur notre plateforme...'],
    ['question' => 'Comment obtenir des signaux de trading ?', 'answer' => 'C\'est simple : inscrivez-vous, choisissez votre abonnement...'],
    ['question' => 'Quels sont les signaux de trading ?', 'answer' => 'Ce sont des recommandations d\'achat ou de vente...'],
];
@endphp

<div class="mx-auto mt-4 w-full">
    <div class="grid grid-cols-1 gap-x-8 gap-y-2 lg:grid-cols-2 lg:items-start">
        @foreach ($faqs as $index => $faq)
            <div x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex w-full items-center justify-between py-3 text-left text-sm font-medium text-gray-700 hover:text-[#0554F1]">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-beat fa-circle-question  h-5 w-5 text-[#0554F1]"></i>
                        <span>{{ $faq['question'] }}</span>
                    </div>
                    <i class="fa-solid fa-chevron-up h-4 w-4 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="pb-2 text-sm text-gray-500">
                    <p>{{ $faq['answer'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>