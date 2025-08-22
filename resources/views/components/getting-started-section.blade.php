{{-- resources/views/components/getting-started-section.blade.php --}}

@php
    $stepTexts = __('welcome.getting_started.steps');
    $steps = [
        ['number' => '01', 'description' => $stepTexts[0], 'fa_icon_class' => 'fa-solid fa-wallet fa-flip'],
        ['number' => '02', 'description' => $stepTexts[1], 'fa_icon_class' => 'fa-brands fa-bitcoin fa-flip'],
        ['number' => '03', 'description' => $stepTexts[2], 'fa_icon_class' => 'fa-solid fa-envelope fa-flip'],
        ['number' => '04', 'description' => $stepTexts[3], 'fa_icon_class' => 'fa-solid fa-chart-line fa-flip'],
    ];
@endphp

<section class="bg-[#12141D] text-center mx-auto py-20 sm:py-12">
    <div class="mx-auto max-w-7xl  px-6 lg:px-0">
        {{-- Titre de la section --}}
        <x-animated-div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-[40px]">
                {!! __('welcome.getting_started.title_html') !!}
            </h2>
        </x-animated-div>

        {{-- Conteneur des étapes avec position relative pour la ligne --}}
        <div class="  relative mt-20">
            {{-- Ligne pointillée en arrière-plan --}}
            <div class="absolute left-1/2 top-16 hidden h-[1px] w-[calc(100%-10rem)] -translate-x-1/2 border-t border-dashed border-cyan-400/30 lg:block"
                aria-hidden="true"></div>

            {{-- Grille des étapes --}}
            <div class="grid grid-cols-1  items-center gap-y-16 gap-x-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($steps as $index => $step)
                    <x-animated-div :delay="$index * 150" class="flex flex-col items-center gap-4 text-center">
                        {{-- Cercle principal --}}
                        <div
                            class="relative flex h-32 w-32 items-center  mx-auto justify-center rounded-full border-2 border-[#00AFFF] bg-[#12141D]">
                            {{-- Icône Font Awesome --}}
                            <i class="{{ $step['fa_icon_class'] }} text-5xl text-white"></i>

                            {{-- Bulle avec le numéro --}}
                            <div
                                class="absolute -right-5 top-10 flex h-10 w-10 items-center justify-center rounded-full bg-[#00AFFF] text-lg font-bold text-[#12141D]">
                                {{ $step['number'] }}
                            </div>
                        </div>

                        {{-- Description de l'étape --}}
                        <p class="w-4/5 mt-2 mx-auto max-w-xs   text-[15px] text-white">
                            {{ $step['description'] }}
                        </p>
                    </x-animated-div>
                @endforeach
            </div>
        </div>
    </div>
</section>
