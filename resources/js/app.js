import './bootstrap';

// ===================================
// 1. IMPOR SEMUA ASET SPESIFIK HALAMAN
// ===================================

// --- Impor CSS Halaman ---
// PASTIKAN 3 BARIS INI ADA UNTUK SLIDER
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/pagination';

import '../css/pages/home.css';
import '../css/pages/produk.css';
import '../css/pages/aktivitas.css';
// ... sisa impor CSS ...

// --- Impor JS Halaman ---
import './pages/home-swiper.js'; // (File yang baru saja kita perbaiki)
import './pages/produk-ajax.js';
import './pages/aktivitas-modal.js';

// ===================================
// 2. LOGIKA JS GLOBAL
// ===================================

// Impor Lucide
import { createIcons, icons } from 'lucide';

document.addEventListener('DOMContentLoaded', () => {
    
    // --- Logika Mobile Menu (dari navbar.blade.php Anda) ---
    const mobileMenuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    
    if(mobileMenuBtn && mobileMenu && mobileMenuOverlay) {
        const mobileMenuIcon = mobileMenuBtn.querySelector('i');
        
        mobileMenuBtn.addEventListener('click', () => {
            const isMenuOpen = !mobileMenu.classList.contains('hidden');
            
            mobileMenu.classList.toggle('hidden');
            mobileMenuOverlay.classList.toggle('hidden');
            
            mobileMenuIcon.setAttribute('data-lucide', isMenuOpen ? 'menu' : 'x');
            // Render ulang ikon yang berubah
            createIcons({ icons, attrs: { 'data-lucide': isMenuOpen ? 'menu' : 'x' } });
            
            // Hentikan scroll body (di <html>)
            document.documentElement.style.overflow = isMenuOpen ? '' : 'hidden';
        });
    }

    // --- Logika Sembunyikan Header ---
    const header = document.querySelector('header.sticky-header'); // Pastikan <header> punya kelas 'sticky-header'
    let lastScrollTop = 0;

    window.addEventListener('scroll', () => {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (header && scrollTop > lastScrollTop && scrollTop > header.offsetHeight) {
            if (!mobileMenu || mobileMenu.classList.contains('hidden')) {
                header.classList.add('-translate-y-full');
            }
        } else if(header) {
            header.classList.remove('-translate-y-full');
        }
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }, false);

    // --- Logika Animasi 'reveal' ---
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => { 
            if(entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.reveal-animation').forEach(el => observer.observe(el));
    
    // Inisialisasi semua ikon Lucide saat halaman dimuat
    createIcons({ icons });

});