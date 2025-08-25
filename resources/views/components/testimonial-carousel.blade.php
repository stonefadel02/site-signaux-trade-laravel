{{-- resources/views/components/testimonial-carousel.blade.php --}}

{{-- Le bloc @php a été supprimé. On utilise directement les traductions. --}}

<div
    x-data="{
        embla: null,
        init() {
            this.embla = EmblaCarousel(this.$refs.emblaViewport, { loop: true, align: 'start' }, [
                Autoplay({ delay: 4000, stopOnInteraction: false })
            ]);
        }
    }"
    class="relative overflow-hidden"
>
    <div x-ref="emblaViewport">
        <div class="flex">
            {{-- On boucle sur les témoignages depuis le fichier de langue --}}
            @foreach (__('welcome.testimonials.list') as $testimonial)
                <div class="relative min-w-0 basis-full flex-shrink-0 flex-grow-0 pl-4">
                    <figure class="relative h-full rounded-[30px] border-2 border-[#00AFFF] bg-[#12141D] p-8">
                        <div class="absolute top-14 left-8 -translate-y-1/2">
                            <img
                                class="h-20 w-20 rounded-full object-cover ring-4 ring-[#1E2027]"
                                src="{{ asset($testimonial['imageSrc']) }}"
                                alt="{{ $testimonial['name'] }}"
                            />
                        </div>
                        <blockquote class="pt-20 text-gray-300">
                            <p>“{{ $testimonial['quote'] }}”</p>
                        </blockquote>
                        <figcaption class="mt-6">
                            <div class="font-semibold text-white">{{ $testimonial['name'] }}</div>
                            <div class="text-gray-400">{{ $testimonial['role'] }}</div>
                        </figcaption>
                    </figure>
                </div>
            @endforeach
        </div>
    </div>
</div>