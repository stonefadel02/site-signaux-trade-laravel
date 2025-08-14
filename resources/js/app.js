import "./bootstrap";
import intersect from "@alpinejs/intersect";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
Alpine.plugin(intersect);
window.Alpine = Alpine;

import EmblaCarousel from "embla-carousel";
import Autoplay from "embla-carousel-autoplay";
window.Autoplay = Autoplay;
window.EmblaCarousel = EmblaCarousel;
