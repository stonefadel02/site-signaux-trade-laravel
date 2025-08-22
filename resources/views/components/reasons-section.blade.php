{{-- resources/views/components/reasons-section.blade.php --}}

{{-- On définit les données pour les 4 cartes directement dans la vue --}}
@php
    $reasonsData = __('welcome.reasons.list');
    // Merge icons while keeping translation content
    $icons = ['c1.png', 'c2.png', 'c3.png', 'c4.png'];
    $reasons = [];
    foreach ($reasonsData as $idx => $row) {
        $reasons[] = [
            'name' => $row['name'],
            'description' => $row['desc'],
            'icon_src' => $icons[$idx] ?? 'c1.png',
        ];
    }
@endphp

<section class="bg-[#12141D] py-10">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        {{-- Titre de la section --}}
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-[40px]">
                {{ __('welcome.reasons.title') }}
            </h2>
            <p class="mt-4 text-[22px] font-bold leading-8 text-white">
                {{ __('welcome.reasons.subtitle') }}
            </p>
        </div>

        {{-- Grille des raisons --}}
        <div
            class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 sm:grid-cols-2 lg:mx-auto lg:max-w-2xl lg:grid-cols-2">
            @foreach ($reasons as $reason)
                <div class="rounded-2xl bg-gradient-to-br from-[#1E2028]/0 to-[#1E2028] p-8">
                    <div class="gap-x-4 text-center">
                        <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-lg">
                            <img src="{{ asset($reason['icon_src']) }}" alt="{{ $reason['name'] }}">
                        </div>
                        <h3 class="mt-4 text-lg text-[25px] font-semibold leading-8 text-white">
                            {{ $reason['name'] }}
                        </h3>
                    </div>
                    <ul role="list" class="mt-6 space-y-3 text-center text-sm leading-6 text-white">
                        @foreach ($reason['description'] as $item)
                            <li class="flex items-center justify-center gap-x-1">
                                <span class="text-cyan-400 font-bold">-</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
