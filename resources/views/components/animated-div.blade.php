{{-- resources/views/components/animated-div.blade.php --}}
@props(['delay' => 0])

<div 
    x-data="{ inView: false }"
    x-intersect:enter="inView = true"
    x-intersect:leave="inView = false"
    class="transition-all  duration-700  ease-out"
    :style="{ transitionDelay: '{{ $delay }}ms' }"
    :class="{ 'opacity-100 translate-y-0': inView, 'opacity-0 translate-y-8': !inView }"
    {{ $attributes }}
>
    {{ $slot }}
</div>