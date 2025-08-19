{{-- resources/views/components/testimonial-carousel.blade.php --}}

@php
$testimonials = [
    [
        'quote' => "Je suis bluffé par la précision ! Avant Triple7SignalsPerDay, je passais des heures à analyser des Graphes sans grand succès. Maintenant, je suis les signaux des experts et mes opérations sont bien plus rentables.",
        'name' => 'Alex METONOU',
        'role' => 'Étudiant',
        'imageSrc' => 'testi.png',
    ],
    // [
    //     'quote' => "En tant que développeuse, mon temps est précieux. Les signaux de Triple7SignalsPerDay sont clairs, rapides à exécuter et surtout, rentables. L'interface est simple et efficace. Je recommande à 100% !",
    //     'name' => 'Elodie K.',
    //     'role' => 'Développeuse',
    //     'imageSrc' => 'testi.png',
    // ],
    // [
    //     'quote' => "J'étais sceptique au début, mais les résultats parlent d'eux-mêmes. L'abonnement mensuel a été remboursé en quelques jours. Une équipe de support réactive en plus. Vraiment top.",
    //     'name' => 'Marc A.',
    //     'role' => 'Entrepreneur',
    //     'imageSrc' => 'testi.png',
    // ],
];
@endphp

<div
    x-data="{
        embla: null,
        init() {
            this.embla = EmblaCarousel(this.$refs.emblaViewport, { loop: true, align: 'start' }, [
                // Initialisation du plugin Autoplay
                Autoplay({ delay: 4000, stopOnInteraction: false })
            ]);
        }
    }"
    class="relative overflow-hidden"
>
    <div class="sm:overflow-hidden" x-ref="viewport">
        <div class="sm:flex">
            @foreach ($testimonials as $testimonial)
                {{-- Chaque slide --}}
                <div class="relative min-w-0 basis-full flex-shrink-0 flex-grow-0 pl-4">
                    <figure class="relative  h-full rounded-[30px] border-2 border-[#00AFFF] bg-[#12141D] p-8">
                        {{-- Image de profil qui dépasse --}}
                        <div class="absolute top-14 left-8 -translate-y-1/2">
                            <img
                                class="h-20 w-20 rounded-full object-cover ring-4 ring-[#1E2027]"
                                src="{{ asset($testimonial['imageSrc']) }}"
                                alt="{{ $testimonial['name'] }}"
                            />
                        </div>

                        <blockquote class="pt-20 text-gray-300">
                            <p>“{{ $testimonial['quote'] }}”</p>
                        </blockquote>
                        <figcaption class="mt-6">
                            <div class="font-semibold text-white">{{ $testimonial['name'] }}</div>
                            <div class="text-gray-400">{{ $testimonial['role'] }}</div>
                        </figcaption>
                    </figure>
                </div>
            @endforeach
        </div>
    </div>
</div>