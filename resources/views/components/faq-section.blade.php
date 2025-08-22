{{-- resources/views/components/faq-section.blade.php --}}

@php
    $faqs = __('welcome.faq.items');
@endphp

<section class="bg-[#12141D] py-20 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="rounded-3xl bg-[#0D192F] p-8 sm:p-12 lg:py-32">
            <x-animated-div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl text-center font-bold tracking-tight text-white sm:text-4xl">
                    {{ __('welcome.faq.title') }}
                </h2>
            </x-animated-div>

            <div class="mx-auto mt-12 w-full max-w-5xl">
                <div class="grid grid-cols-1 gap-x-8 gap-y-4 lg:grid-cols-2 lg:items-start">
                    @foreach ($faqs as $index => $faq)
                        <x-animated-div :delay="$index * 100" class="w-full border-b border-white/5 pb-4">
                            <div x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }" class="pt-4">
                                {{-- Bouton pour ouvrir/fermer la question --}}
                                <button @click="open = !open"
                                    class="flex w-full items-center justify-between rounded-lg px-4 py-3 text-left text-sm font-medium hover:bg-white/5 focus:outline-none focus-visible:ring focus-visible:ring-cyan-500/75 transition-colors"
                                    :class="{ 'text-white': open, 'text-[#00AFFF]': !open }">
                                    <div class="flex items-center gap-3 text-[15px] font-bold">
                                        <i class="fa-solid fa-beat fa-circle-question h-5 w-5 text-current"></i>
                                        <span>{{ $faq['q'] }}</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-up h-5 w-5 text-current transition-transform"
                                        :class="{ 'rotate-180': open }"></i>
                                </button>

                                {{-- Panneau de la réponse --}}
                                <div x-show="open" x-collapse class="px-4 pt-4 pb-2 text-sm text-white">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </div>
                        </x-animated-div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
