
import EmblaCarousel from 'embla-carousel';
import Autoplay from 'embla-carousel-autoplay';

document.addEventListener('alpine:init', () => {
    Alpine.data('carousel', () => ({
        embla: null,
        init() {
            this.embla = EmblaCarousel(this.$refs.viewport, { loop: true }, [
                Autoplay({ delay: 4000, stopOnInteraction: false })
            ]);
        }
    }));
});