
import './bootstrap';


import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import collapse from '@alpinejs/collapse'; 
Alpine.plugin(intersect);
Alpine.plugin(collapse);

window.Alpine = Alpine;

Alpine.start();


import EmblaCarousel from 'embla-carousel';
import Autoplay from 'embla-carousel-autoplay';

window.EmblaCarousel = EmblaCarousel;
window.Autoplay = Autoplay;
import './carousel.js';