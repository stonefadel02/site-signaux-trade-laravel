{{-- resources/views/components/features-section.blade.php --}}

<section class="bg-[#12141D] py-20 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto flex max-w-2xl flex-col gap-16 sm:gap-y-20 lg:mx-0 lg:max-w-none">

            {{-- PREMIER BLOC : 30 SIGNAUX PAR JOUR --}}
            <div style="background-image: url('{{ asset('bg2.png') }}')"
                class="rounded-[30px] bg-cover bg-center bg-no-repeat bg-[#1E2027] p-4 ring-1 ring-white/10 sm:p-10 lg:p-16">
                <div class="grid grid-cols-1 items-center gap-12 py-5 lg:grid-cols-2 lg:gap-8">
                    {{-- Colonne de gauche : Image du laptop --}}
                    <div class="flex justify-center">
                        <img src="{{ asset('laptop.png') }}" alt="Interface de trading sur un laptop"
                            class="w-full max-w-md" />
                    </div>

                    {{-- Colonne de droite : Texte --}}
                    <div class="mx-2 text-center lg:text-left">
                        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-[40px]">
                            {!! __('welcome.features.block1.title_html') !!}
                        </h2>
                        <p class="mt-6 text-lg leading-8 text-gray-300">
                            {{ __('welcome.features.block1.paragraph') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- DEUXIÈME BLOC : ÉQUIPE QUALIFIÉE --}}
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2 lg:gap-8">
                {{-- Colonne de gauche : Texte --}}
                <div class="sm:mx-20 text-center lg:text-left">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-[40px]">
                        {!! __('welcome.features.block2.title_html') !!}
                    </h2>
                    <p class="mt-6 text-lg leading-8 text-gray-300">
                        {{ __('welcome.features.block2.paragraph') }}
                    </p>
                </div>

                {{-- Colonne de droite : Image du trader --}}
                <div class="flex justify-center">
                    <img src="{{ asset('trader.png') }}" alt="Trader professionnel à son bureau"
                        class="rounded-2xl shadow-2xl shadow-blue-500/20" />
                </div>
            </div>

        </div>
    </div>
</section>
