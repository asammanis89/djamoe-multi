// ==========================================
// 1. GLOBAL FUNCTIONS
// ==========================================

// Variabel referensi element (tidak perlu const di sini agar tidak error redeclaration jika hot reload)
// Kita gunakan window object agar global access aman
window.openModal = function(imageSrc) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const modalContent = document.getElementById('modalContent');

    // Safety check
    if (!modal || !modalImg) {
        console.error('Element modal tidak ditemukan di DOM');
        return;
    }
    
    modalImg.src = imageSrc;
    modal.classList.remove('hidden');
    
    // Timeout kecil agar transisi CSS berjalan halus
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        if(modalContent) {
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }
    }, 10);
    
    document.body.style.overflow = 'hidden'; // Matikan scroll body
};

window.closeModal = function() {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const modalContent = document.getElementById('modalContent');

    if (!modal) return;
    
    modal.classList.add('opacity-0');
    if(modalContent) {
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
    }
    
    setTimeout(() => {
        modal.classList.add('hidden');
        if(modalImg) modalImg.src = ''; 
    }, 300);
    
    document.body.style.overflow = 'auto'; // Hidupkan scroll body
};

// Tutup Modal dengan tombol ESCAPE
document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        window.closeModal();
    }
});

// ==========================================
// 2. MAIN LOGIC (Saat Halaman Selesai Dimuat)
// ==========================================
document.addEventListener('DOMContentLoaded', function () {
    
    // --- A. HERO SWIPER LOGIC ---
    let heroSwiper = null; 
    const heroSliderEl = document.querySelector('.hero-swiper');

    if (typeof Swiper !== 'undefined' && heroSliderEl) {
        heroSwiper = new Swiper('.hero-swiper', {
            loop: true,
            effect: 'slide',
            speed: 1200,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            on: {
                slideChange: function () {
                    // Optional chaining (?.) biar aman
                    const nextSlide = this.slides[this.activeIndex + 1];
                    const img = nextSlide ? nextSlide.querySelector('img') : null;
                    if (img) img.loading = 'eager';
                }
            }
        });

        // Keyboard Control
        document.addEventListener('keydown', function(e) {
            if (heroSwiper && !heroSwiper.destroyed) {
                if (e.key === 'ArrowLeft') heroSwiper.slidePrev();
                else if (e.key === 'ArrowRight') heroSwiper.slideNext();
            }
        });

        // Smart Autoplay
        document.addEventListener('visibilitychange', function() {
            if (heroSwiper && heroSwiper.autoplay && !heroSwiper.destroyed) {
                if (document.hidden) {
                    heroSwiper.autoplay.stop();
                } else {
                    heroSwiper.autoplay.start();
                }
            }
        });
        
        console.log('✅ Hero Swiper initialized');
    }

    // --- B. SCROLL REVEAL ANIMATION ---
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px',
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.reveal-animation').forEach(el => {
        observer.observe(el);
    });
    
    // --- C. SMOOTH SCROLL ANCHOR ---
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#' || !targetId) return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const headerOffset = 10;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});