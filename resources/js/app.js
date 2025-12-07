import './bootstrap';

// ===================================
// 1. IMPOR SEMUA ASET SPESIFIK HALAMAN
// ===================================

// --- Impor CSS Halaman ---
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/pagination';

import '../css/pages/home.css';
import '../css/pages/produk.css';
import '../css/pages/aktivitas.css';

// --- Impor JS Halaman ---
// Pastikan file-file ini ada, kalau tidak ada error, biarkan saja
import './pages/home-swiper.js'; 
import './pages/produk-ajax.js';
import './pages/aktivitas-modal.js';

// ===================================
// 2. LOGIKA JS GLOBAL
// ===================================

// Impor Lucide (Ikon)
import { createIcons, icons } from 'lucide';

document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. Inisialisasi Ikon Lucide ---
    // Ini penting supaya ikon-ikon di halaman lain (selain navbar) tetap muncul
    createIcons({ icons });

    // --- 2. Logika Animasi 'reveal' (Efek muncul pelan-pelan) ---
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => { 
            if(entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.reveal-animation').forEach(el => observer.observe(el));

    // CATATAN:
    // Logika Mobile Menu & Sticky Header SUDAH DIHAPUS dari sini.
    // Sekarang logic-nya diurus langsung oleh navbar.blade.php supaya tidak bentrok.

});