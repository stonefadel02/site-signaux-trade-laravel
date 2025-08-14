{{-- resources/views/components/contact-section.blade.php --}}

@php
$contactDetails = [
    ['icon_src' => 'g1.png', 'text' => 'Example@gmail.com'],
    ['icon_src' => 'g2.png', 'text' => '+00 00 000 0000'],
    ['icon_src' => 'g3.png', 'text' => 'Cotonou, Bénin'],
];
@endphp

<section class="bg-[#12141D] py-20 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        {{-- Conteneur principal avec le fond plus clair et coins arrondis --}}
        <div class="rounded-3xl bg-[#0D192F] p-8 sm:p-12 lg:p-16">
            <x-animated-div class="mx-auto max-w-xl text-center">
                <h2 class="mt-4 text-3xl text-center font-bold tracking-tight text-white sm:text-4xl">
                    Nous contacter
                </h2>
            </x-animated-div>

            {{-- Informations de contact (email, téléphone, adresse) --}}
            <div class="mt-24 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($contactDetails as $index => $detail)
                    <x-animated-div
                        :delay="$index * 150"
                        class=""
                    >
<div class="flex items-center justify-center gap-4">
                            <img src="{{ asset($detail['icon_src']) }}" alt="" class="h-20 w-20">
                        <label class="text-[20px] text-white">{{ $detail['text'] }}</label>
</div>
                    </x-animated-div>
                @endforeach
            </div>

            {{-- Contenu principal : Image et Formulaire --}}
            <div class="mt-16 grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
                {{-- Colonne de gauche : Image --}}
                <x-animated-div :delay="100" class="flex justify-center">
                    <img
                        src="{{ asset('headphones.png') }}"
                        alt="Casque de support 3D"
                        class="w-80 max-w-sm"
                    />
                </x-animated-div>

                {{-- Colonne de droite : Formulaire --}}
                <x-animated-div :delay="250" class="w-full">
                    <div class="rounded-[30px] bg-[#12141D] mx-10 p-10">
                        <h3 class="text-lg font-semibold text-white">
                            Nous contacter
                        </h3>
                        <form action="#" method="POST" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="sr-only">Votre Nom</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    placeholder="Votre Nom"
                                    class="block w-full rounded-[10px] border-0 bg-[#0D192F] px-4 py-3 text-white placeholder:text-[#4F4F4F] focus:ring-2 focus:ring-inset focus:ring-cyan-500 sm:text-sm"
                                />
                            </div>
                            <div>
                                <label for="email" class="sr-only">Votre Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    placeholder="Votre Email"
                                    class="block w-full rounded-[10px] border-0 bg-[#0D192F] px-4 py-3 text-white placeholder:text-[#4F4F4F] focus:ring-2 focus:ring-inset focus:ring-cyan-500 sm:text-sm"
                                />
                            </div>
                            <div>
                                <label for="phone" class="sr-only">Téléphone</label>
                                <input
                                    type="tel"
                                    name="phone"
                                    id="phone"
                                    placeholder="Téléphone"
                                    class="block w-full rounded-[10px] border-0 bg-[#0D192F] px-4 py-3 text-white placeholder:text-[#4F4F4F] focus:ring-2 focus:ring-inset focus:ring-cyan-500 sm:text-sm"
                                />
                            </div>
                            <div>
                                <label for="message" class="sr-only">Message</label>
                                <textarea
                                    name="message"
                                    id="message"
                                    rows="4"
                                    placeholder="Message"
                                    class="block w-full rounded-[10px] border-0 border-none bg-[#0D192F] px-4 py-3 text-white placeholder:text-[#4F4F4F] focus:ring-2 focus:ring-inset focus:ring-cyan-500 sm:text-sm"
                                ></textarea>
                            </div>
                            <div>
                                <button
                                    type="submit"
                                    class="flex w-1/3 cursor-pointer justify-center rounded-[10px] bg-[#00AFFF] px-3.5 py-2.5 text-center text-sm font-semibold shadow-sm hover:bg-cyan-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-500"
                                >
                                    ENVOYER
                                </button>
                            </div>
                        </form>
                    </div>
                </x-animated-div>
            </div>
        </div>
    </div>
</section>