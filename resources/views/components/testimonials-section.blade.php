{{-- resources/views/components/testimonials-section.blade.php --}}

<section class="bg-[#12141D] py-20 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="grid sm:grid-cols-1 items-center gap-16 lg:grid-cols-2">
            {{-- Colonne de gauche : Texte --}}
               <x-animated-div class="">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Témoignages
                </h2>
                <p class="mt-4 text-lg leading-8 text-gray-300">
                    Nos signaux de trading payants particulièrement appréciés par ceux
                    qui recherchent des signaux de trading rentables.
                </p
            </x-animated-div>

            {{-- Colonne de droite : Carrousel --}}
              <x-animated-div :delay="150">
                <x-testimonial-carousel />
            </x-animated-div>
        </div>
    </div>
</section>