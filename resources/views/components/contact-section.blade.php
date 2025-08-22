{{-- resources/views/components/contact-section.blade.php --}}

@php
    $details = __('welcome.contact.details');
    $contactDetails = [
        ['icon_src' => 'g1.png', 'text' => $details['email']],
        ['icon_src' => 'g2.png', 'text' => $details['phone']],
        ['icon_src' => 'g3.png', 'text' => $details['address']],
    ];
    $formT = __('welcome.contact.form');
@endphp

<section class="bg-[#12141D] py-20 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        {{-- Conteneur principal avec le fond plus clair et coins arrondis --}}
        <div class="rounded-3xl bg-[#0D192F] p-4 sm:p-12 lg:p-16">
            <x-animated-div class="mx-auto max-w-xl text-center">
                <h2 class="mt-4 text-3xl text-center font-bold tracking-tight text-white sm:text-4xl">
                    {{ __('welcome.contact.title') }}
                </h2>
            </x-animated-div>

            {{-- Informations de contact (email, téléphone, adresse) --}}
            <div class="mt-24 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($contactDetails as $index => $detail)
                    <x-animated-div :delay="$index * 150" class="">
                        <div class="flex sm:items-center sm:justify-center gap-4">
                            <img src="{{ asset($detail['icon_src']) }}" alt="" class="sm:h-20 h-10 w-10 sm:w-20">
                            <label class="sm:text-[20px] sm:mt-0 mt-1 text-white">{{ $detail['text'] }}</label>
                        </div>
                    </x-animated-div>
                @endforeach
            </div>

            {{-- Contenu principal : Image et Formulaire --}}
            <div class="mt-16 grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
                {{-- Colonne de gauche : Image --}}
                <x-animated-div :delay="100" class="flex justify-center">
                    <img src="{{ asset('headphones.png') }}" alt="Casque de support 3D"
                        class="sm:w-80 w-56  max-w-sm" />
                </x-animated-div>

                {{-- Colonne de droite : Formulaire --}}
                <x-animated-div :delay="250" class="w-full">
                    <div class="rounded-[30px] bg-[#12141D] sm:mx-10 p-10">
                        <h3 class="text-lg font-semibold text-white">
                            {{ __('welcome.contact.title') }}
                        </h3>
                        <form action="#" method="POST" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="sr-only">{{ $formT['name'] }}</label>
                                <input type="text" name="name" id="name" placeholder="{{ $formT['name'] }}"
                                    class="block w-full rounded-[10px] border-0 bg-[#0D192F] px-4 py-3 text-white placeholder:text-[#4F4F4F] focus:ring-2 focus:ring-inset focus:ring-cyan-500 sm:text-sm" />
                            </div>
                            <div>
                                <label for="email" class="sr-only">{{ $formT['email'] }}</label>
                                <input type="email" name="email" id="email" placeholder="{{ $formT['email'] }}"
                                    class="block w-full rounded-[10px] border-0 bg-[#0D192F] px-4 py-3 text-white placeholder:text-[#4F4F4F] focus:ring-2 focus:ring-inset focus:ring-cyan-500 sm:text-sm" />
                            </div>
                            <div>
                                <label for="phone" class="sr-only">{{ $formT['phone'] }}</label>
                                <input type="tel" name="phone" id="phone" placeholder="{{ $formT['phone'] }}"
                                    class="block w-full rounded-[10px] border-0 bg-[#0D192F] px-4 py-3 text-white placeholder:text-[#4F4F4F] focus:ring-2 focus:ring-inset focus:ring-cyan-500 sm:text-sm" />
                            </div>
                            <div>
                                <label for="message" class="sr-only">{{ $formT['message'] }}</label>
                                <textarea name="message" id="message" rows="4" placeholder="{{ $formT['message'] }}"
                                    class="block w-full rounded-[10px] border-0 border-none bg-[#0D192F] px-4 py-3 text-white placeholder:text-[#4F4F4F] focus:ring-2 focus:ring-inset focus:ring-cyan-500 sm:text-sm"></textarea>
                            </div>
                            <div>
                                <button type="submit"
                                    class="flex w-1/3 cursor-pointer justify-center rounded-[10px] bg-[#00AFFF] sm:px-3.5 px-6 py-2.5 text-center text-sm font-semibold shadow-sm hover:bg-cyan-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-500">
                                    {{ $formT['submit'] }}
                                </button>
                            </div>
                        </form>
                    </div>
                </x-animated-div>
            </div>
        </div>
    </div>
</section>
