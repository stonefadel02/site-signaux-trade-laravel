import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
Alpine.plugin(intersect);
window.Alpine = Alpine;
Alpine.start();

import EmblaCarousel from 'embla-carousel';
import Autoplay from 'embla-carousel-autoplay';
window.Autoplay = Autoplay;
window.EmblaCarousel = EmblaCarousel;
