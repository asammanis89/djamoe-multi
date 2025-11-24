import Swiper from 'swiper';
import { Autoplay, EffectFade, Pagination } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.hero-swiper')) {
        new Swiper('.hero-swiper', {
            // Beritahu Swiper modul apa yang harus digunakan
            modules: [Autoplay, EffectFade, Pagination], 
            
            loop: true, 
            effect: 'fade', 
            autoplay: {
                delay: 5000, 
                disableOnInteraction: false
            }, 
            pagination: { 
                el: '.hero-swiper .swiper-pagination', 
                clickable: true 
            } 
        });
    }
});