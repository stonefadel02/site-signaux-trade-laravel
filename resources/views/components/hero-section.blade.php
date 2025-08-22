{{-- resources/views/components/hero-section.blade.php --}}

<section class="relative flex min-h-[800px] w-full items-center bg-cover bg-center sm:pt-20"
    style="background-image: url('{{ asset('bg.png') }}')">
    {{-- Superposition de couleur sombre pour la lisibilité du texte --}}
    <div class="absolute inset-0 bg-black/40"></div>

    {{-- Conteneur du contenu, centré et au-dessus de la superposition --}}
    <div class="relative sm:pt-40 pb-10 z-10 mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            {{-- Titre principal --}}
            <h1 class="text-3xl font-bold tracking-tight text-white sm:text-5xl md:text-[55px]">
                {{ __('welcome.hero.heading_line1') }}
                <br />
                <span class="text-blue-400">{{ __('welcome.hero.heading_highlight') }} </span>
                {{ __('welcome.hero.heading_after_highlight') }}
            </h1>

            {{-- Paragraphe de description --}}
            <p class="mt-6 w-5/6 sm:text-[20px] text-[15px] leading-8 text-white">
                {{ __('welcome.hero.paragraph') }}
            </p>

            {{-- Conteneur pour les boîtes d'information --}}
            <div class="mt-10 flex max-w-sm flex-col gap-4">
                {{-- Boîte 1 : 3 sessions --}}
                <div
                    class="flex items-center gap-4 rounded-lg border-l-4 border-yellow-400 bg-gradient-to-r from-[#25283A] to-[#1E2027] p-4 backdrop-blur-sm">
                    <i class="fa-regular fa-clock fa-shake ml-5 text-yellow-400 sm:text-6xl text-4xl"></i>
                    <span class="sm:text-[30px] text-[19px] font-semibold text-white">
                        {{ __('welcome.hero.box_sessions') }}
                    </span>
                </div>
            </div>

            {{-- Boîte 2 : 10 signaux --}}
            <div
                class="mt-10 flex max-w-[320px] items-center gap-4 rounded-lg bg-gradient-to-r from-[#25283A] to-[#3A51A1] p-3 backdrop-blur-sm">
                <i class="fa-solid fa-beat fa-chart-bar ml-5 text-cyan-300 sm:text-6xl text-4xl"></i>
                <span class="sm:text-[33px] text-[22px] font-semibold text-white">
                    {{ __('welcome.hero.box_signals') }}
                </span>
            </div>
        </div>
    </div>
</section>
