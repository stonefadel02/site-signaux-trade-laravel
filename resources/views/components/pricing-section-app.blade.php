{{-- resources/views/components/pricing-section.blade.php --}}

<section class="">
    <div class="mx-auto max-w-7xl">
        <div class="">
            <div class="isolate mx-auto grid max-w-md grid-cols-1 gap-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach ($plans as $plan)
                    <div class="flex flex-col">
                        <div class="flex h-full flex-col rounded-[15px] bg-[#12141D] p-8 ring-1 ring-white/10">
                            
                            {{-- Nom du plan --}}
                            <h3 class="text-[20px] font-semibold leading-8 text-white">
                                {{ $plan->Titre }}
                            </h3>

                            {{-- Prix --}}
                            <p class="mt-4 flex items-baseline gap-x-1">
                                <span class="text-[45px] font-bold tracking-tight text-white">
                                    {{ $plan->Prix }}$
                                </span>
                                <span class="text-[20px] font-semibold leading-6 text-white">
                                    /{{ $plan->getFrequence() }}
                                </span>
                            </p>

                            {{-- Sous-texte prix si dispo --}}
                            @if($plan->price_subtext ?? false)
                                <p class="mt-2 text-[15px] text-[#00AFFF]">
                                    {{ $plan->price_subtext }}
                                </p>
                            @endif

                            <hr class="my-3 border-[#00AFFF]" />

                            {{-- Features --}}
                            <ul role="list" class="mt-8 space-y-3 text-[16px] font-bold leading-6 text-white">
                                @foreach ($plan->getFeatures() as $feature)
                                    <li class="flex gap-x-3">
                                        <img src="{{ asset('check.png') }}" alt="Checkmark" class="h-6 w-5">
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="flex-grow"></div>

                            {{-- Bouton choisir -> lance le paiement --}}
                            <form action="{{ route('paiement.initier') }}" method="POST" class="mt-8">
                                @csrf
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <button type="submit"
                                    class="block w-1/2 rounded-[10px] border border-[#00AFFF] px-3 py-3 text-center text-sm leading-6 transition-colors bg-[#00AFFF] text-[#12141D] shadow-sm hover:bg-cyan-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#00AFFF]">
                                    CHOISIR
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
