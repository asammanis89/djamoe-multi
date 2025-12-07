<?php $__env->startSection('title', __('Beranda') . " - D'jamoe"); ?>

<?php $__env->startPush('styles'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/pages/home.css'); ?>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="relative w-full aspect-[4/5] md:aspect-auto md:h-[100dvh] bg-[#1A3A24] group overflow-hidden">
    
    <div class="absolute inset-0 w-full h-full z-0">
        <div class="swiper-container hero-swiper w-full h-full">
            <div class="swiper-wrapper">
                <?php $__empty_1 = true; $__currentLoopData = $flyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="swiper-slide w-full h-full">
                        <img src="<?php echo e(asset('storage/' . $flyer->image_url)); ?>" alt="Hero" class="w-full h-full object-cover object-center" loading="eager">
                        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="swiper-slide w-full h-full">
                        <img src="<?php echo e(asset('gambar/gambar1.jpg')); ?>" alt="Hero" class="w-full h-full object-cover object-center">
                        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="absolute inset-0 z-20 flex flex-col justify-center items-center text-center px-6 pointer-events-none">
        <div class="max-w-4xl mx-auto pointer-events-auto"> 
            <h1 class="text-2xl md:text-6xl lg:text-7xl font-serif font-bold text-[#E6D793] mb-3 md:mb-8 leading-tight tracking-wide animate-title drop-shadow-lg" style="text-shadow: 0 4px 20px rgba(0,0,0,0.8);">
                <?php echo e(__('Selamat Datang di D\'jamoe')); ?>

            </h1>
            <div class="animate-btn">
                <a href="#outlet" class="inline-flex items-center gap-2 bg-[#E6D793] text-[#1A3A24] py-2 px-5 md:py-3 md:px-10 rounded-full font-serif font-bold tracking-[0.15em] text-[10px] md:text-sm uppercase transition-all duration-300 hover:bg-[#F5E6B3] shadow-lg">
                    <?php echo e(__('Jelajahi Sekarang')); ?>

                    <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>

    
    <div class="absolute bottom-6 md:bottom-10 left-0 right-0 z-30 flex justify-center">
        <div class="swiper-pagination"></div>
    </div>
    <div class="hero-navigation hidden md:block">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <div class="absolute top-20 right-20 w-32 h-32 bg-[#E6D793]/10 rounded-full blur-3xl z-10 animate-pulse-slow hidden md:block"></div>
</section>


<section class="py-16 md:py-24 bg-mint relative">
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-10 md:mb-16">
            <span class="text-[#E6D793] font-bold tracking-widest uppercase text-xs md:text-sm mb-2 block reveal-animation inline-block px-4 py-1 bg-[#1A3A24] rounded-full shadow-md">
                <?php echo e(__('Favorit Pelanggan')); ?>

            </span>
            <h2 class="text-3xl md:text-5xl font-serif font-bold text-[#1A3A24] reveal-animation mt-4">
                <?php echo e(__('Produk Unggulan')); ?>

            </h2>
            <div class="w-16 md:w-24 h-1.5 bg-gradient-to-r from-transparent via-[#E6D793] to-transparent mx-auto mt-4 md:mt-6 rounded-full reveal-animation"></div>
        </div>

        <div class="product-grid-container reveal-animation">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8"> 
                <?php $__empty_1 = true; $__currentLoopData = $featuredProducts->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('produk.index')); ?>" class="card-hover-effect rounded-2xl overflow-hidden h-full flex flex-col group relative bg-white shadow-soft">
                        <div class="relative overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 aspect-square md:aspect-[4/5]">
                            <img src="<?php echo e(asset('storage/' . $product->image_url)); ?>" alt="<?php echo e($product->product_name); ?>" class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-2" loading="lazy">
                        </div>
                        <div class="p-4 md:p-6 text-center flex flex-col flex-grow relative transition-all duration-300">
                            <h3 class="text-sm md:text-xl font-serif font-bold mb-1 md:mb-2 line-clamp-2 leading-tight text-[#1A3A24] transition-colors duration-300">
                                <?php echo e($product->product_name); ?>

                            </h3>
                            <div class="flex-grow"></div>
                            <p class="price-tag font-bold text-sm md:text-base mb-3 text-[#B8860B] transition-colors duration-300">
                                Rp <?php echo e(number_format($product->price ?? 0, 0, ',', '.')); ?>

                            </p>
                            <span class="btn-detail inline-block w-full py-2 rounded-lg text-[10px] md:text-xs font-bold uppercase tracking-wider transition-all duration-300">
                                <?php echo e(__('Lihat Detail')); ?>

                            </span>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full text-center text-gray-400 py-10"><?php echo e(__('Belum ada produk unggulan.')); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<section class="py-16 md:py-24 bg-elegant relative overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-4xl bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-[#E6D793]/10 via-transparent to-transparent pointer-events-none"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16 reveal-animation">
            <span class="inline-block px-4 py-1 bg-[#E6D793]/10 text-[#E6D793] rounded-full text-xs font-bold uppercase tracking-widest mb-4 border border-[#E6D793]/20">
                <?php echo e(__('Terjamin Halal & Legal')); ?>

            </span>
            <h2 class="text-3xl md:text-5xl font-serif font-bold text-[#E6D793] mb-6"><?php echo e(__('Jaminan Kualitas')); ?></h2>
            <p class="text-[#FBF8ED]/80 text-sm md:text-lg leading-relaxed font-light">
                <?php echo e(__('D\'jamoe berkomitmen penuh terhadap ketenangan hati Anda. Produk kami telah teruji dan tersertifikasi resmi.')); ?>

            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 reveal-animation px-2">
            
            <?php
                $certs = [
                    ['img' => 'gambar/halal.jpg', 'title' => 'Halal MUI', 'desc' => 'Terjamin Kehalalannya'],
                    ['img' => 'gambar/halal.jpg', 'title' => 'Izin Dinkes', 'desc' => 'Aman Dikonsumsi'],
                    ['img' => 'gambar/halal.jpg', 'title' => 'HAKI', 'desc' => 'Merek Terdaftar'],
                    ['img' => 'gambar/halal.jpg', 'title' => 'Penghargaan', 'desc' => 'Kualitas Diakui']
                ];
            ?>

            <?php $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cert-3d-card group h-[280px] md:h-[350px]">
                <div class="cert-3d-inner w-full h-full">
                    <div class="cert-3d-front w-full h-full">
                        <img src="<?php echo e(asset($cert['img'])); ?>" onerror="this.src='https://placehold.co/300x400/1A3A24/E6D793?text=<?php echo e($cert['title']); ?>'" class="w-full h-full object-cover">
                        <div class="cert-overlay-bottom">
                            <div class="text-center mb-2">
                                <span class="inline-block px-4 py-1 bg-[#1A3A24] text-[#E6D793] rounded-full text-xs font-bold uppercase tracking-widest shadow-md border border-white/10">
                                    <?php echo e(__($cert['title'])); ?>

                                </span>
                            </div>
                            <p class="cert-desc"><?php echo e(__($cert['desc'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="py-16 md:py-24 bg-mint relative overflow-hidden">
    <div class="container mx-auto px-4 text-center relative z-10">
        <span class="inline-block px-4 py-1 bg-[#1A3A24] text-[#E6D793] rounded-full text-xs font-bold uppercase tracking-widest mb-4 reveal-animation shadow-md">
            <?php echo e(__('Testimoni')); ?>

        </span>
        <h2 class="text-3xl md:text-5xl font-serif font-bold reveal-animation text-[#1A3A24] mb-10 md:mb-16">
            <?php echo e(__('Apa Kata Mereka?')); ?>

        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            
            <div class="card-hover-effect p-6 md:p-8 rounded-2xl reveal-animation text-left flex flex-col h-full bg-white shadow-soft backdrop-blur-sm">
                <div class="price-tag mb-4 text-lg md:text-xl flex gap-1 text-[#E6D793]">★★★★★</div>
                <p class="italic leading-relaxed flex-grow text-sm md:text-base text-gray-600">
                    <?php echo e(__('"Beras Kencurnya juara! Badan langsung terasa segar dan enteng setelah minum."')); ?>

                </p>
                <div class="mt-6 border-t border-gray-100 pt-4">
                    <h3 class="font-bold font-serif text-base md:text-lg text-[#1A3A24]">Anisa</h3>
                    <p class="text-xs uppercase tracking-widest text-gray-400">Karyawan Swasta</p>
                </div>
            </div>
            
            <div class="card-hover-effect p-6 md:p-8 rounded-2xl reveal-animation text-left flex flex-col h-full bg-white shadow-soft backdrop-blur-sm">
                <div class="price-tag mb-4 text-lg md:text-xl flex gap-1 text-[#E6D793]">★★★★★</div>
                <p class="italic leading-relaxed flex-grow text-sm md:text-base text-gray-600">
                    <?php echo e(__('"Suka banget sama Kunir Asemnya. Selalu sedia di kulkas untuk pencernaan. Rasanya premium."')); ?>

                </p>
                <div class="mt-6 border-t border-gray-100 pt-4">
                    <h3 class="font-bold font-serif text-base md:text-lg text-[#1A3A24]">Budi Santoso</h3>
                    <p class="text-xs uppercase tracking-widest text-gray-400">Atlet Renang</p>
                </div>
            </div>
            
            <div class="card-hover-effect p-6 md:p-8 rounded-2xl reveal-animation text-left flex flex-col h-full bg-white shadow-soft backdrop-blur-sm">
                <div class="price-tag mb-4 text-lg md:text-xl flex gap-1 text-[#E6D793]">★★★★★</div>
                <p class="italic leading-relaxed flex-grow text-sm md:text-base text-gray-600">
                    <?php echo e(__('"Wedang Uwuh dari D\'jamoe ini favorit keluarga. Rempahnya terasa asli dan menghangatkan."')); ?>

                </p>
                <div class="mt-6 border-t border-gray-100 pt-4">
                    <h3 class="font-bold font-serif text-base md:text-lg text-[#1A3A24]">Citra</h3>
                    <p class="text-xs uppercase tracking-widest text-gray-400">Ibu Rumah Tangga</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-10 md:py-16 bg-elegant relative overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-10 pointer-events-none"></div>

    <div class="container mx-auto px-4 text-center relative z-10">
        <span class="inline-block px-4 py-1 bg-[#E6D793]/20 text-[#E6D793] rounded-full text-xs font-bold uppercase tracking-widest mb-4 border border-[#E6D793]/30 reveal-animation">
            <?php echo e(__('Partner Terpercaya')); ?>

        </span>
        <h2 class="text-2xl md:text-4xl font-serif font-bold reveal-animation text-white mb-8 md:mb-12">
            <?php echo e(__('Dipercaya Oleh')); ?>

        </h2>
        
        <div class="logo-marquee-container w-full relative">
            <div class="logo-marquee-content">
                <?php 
                    $logos = [
                        ['src' => 'gambar/1_ASTON_REV.webp', 'alt' => 'Aston'],
                        ['src' => 'gambar/1_BANK JATIM_REV.webp', 'alt' => 'Bank Jatim'],
                        ['src' => 'gambar/1_DPRD_REV.webp', 'alt' => 'DPRD'],
                        ['src' => 'gambar/1_INKA_REV.webp', 'alt' => 'INKA'],
                        ['src' => 'gambar/1_JNK_REV.webp', 'alt' => 'JNK'],
                        ['src' => 'gambar/1_LANUD_REV.webp', 'alt' => 'Lanud'],
                        ['src' => 'gambar/1_LOGO UNIPMA_REV.webp', 'alt' => 'Unipma'],
                        ['src' => 'gambar/1_PEMKOT_REV.webp', 'alt' => 'Pemkot'],
                        ['src' => 'gambar/1_IMS_REV.webp', 'alt' => 'IMS'],
                    ];
                ?>

                
                <?php $__currentLoopData = $logos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="logo-item flex-shrink-0 group" onclick="openModal('<?php echo e(asset($logo['src'])); ?>')">
                        <div class="cursor-pointer p-2 md:p-4 rounded-xl border border-transparent transition-all duration-300 hover:bg-white/10 hover:border-white/20 hover:backdrop-blur-sm">
                            <img src="<?php echo e(asset($logo['src'])); ?>" alt="<?php echo e($logo['alt']); ?>" class="partner-logo object-contain" loading="lazy">
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php $__currentLoopData = $logos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="logo-item flex-shrink-0 group" onclick="openModal('<?php echo e(asset($logo['src'])); ?>')">
                        <div class="cursor-pointer p-2 md:p-4 rounded-xl border border-transparent transition-all duration-300 hover:bg-white/10 hover:border-white/20 hover:backdrop-blur-sm">
                            <img src="<?php echo e(asset($logo['src'])); ?>" alt="<?php echo e($logo['alt']); ?>" class="partner-logo object-contain" loading="lazy">
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>


<div id="imageModal" class="fixed inset-0 z-[9999] hidden bg-black/90 backdrop-blur-md flex items-center justify-center p-4 transition-opacity duration-300 opacity-0" onclick="closeModal()">
    <div class="relative transform scale-95 transition-transform duration-300" id="modalContent">
        <button class="absolute -top-12 right-0 text-white/60 hover:text-white transition-colors p-2" onclick="closeModal()">
            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <img id="modalImage" src="" alt="Zoomed Partner" class="max-w-full max-h-[80vh] object-contain rounded-lg">
    </div>
</div>


<section id="outlet" class="py-16 md:py-24 bg-mint relative">
    <div class="container mx-auto px-4 relative z-10">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row reveal-animation border border-gray-100">
            <div class="p-8 md:p-12 md:w-1/3 flex flex-col justify-center bg-[#1A3A24] text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#E6D793]/10 rounded-full blur-3xl"></div>
                <h3 class="text-2xl md:text-3xl font-serif font-bold text-[#E6D793] mb-4 md:mb-6 relative z-10">
                    <?php echo e(__('Kunjungi Outlet')); ?>

                </h3>
                <div class="mb-4 md:mb-6 relative z-10">
                    <p class="text-xs md:text-sm text-[#E6D793] uppercase tracking-wider mb-1 font-bold"><?php echo e(__('Alamat')); ?></p>
                    <p class="text-[#FBF8ED] leading-relaxed text-sm md:text-base">
                        Jl. Ranumenggalan No.41, Mojorejo, <br>Kec. Kartoharjo, Kota Madiun
                    </p>
                </div>
                <div class="mb-6 md:mb-8 relative z-10">
                    <p class="text-xs md:text-sm text-[#E6D793] uppercase tracking-wider mb-1 font-bold"><?php echo e(__('Jam Operasional')); ?></p>
                    <p class="text-[#FBF8ED] text-sm md:text-base">Setiap Hari: 08.00 - 21.00 WIB</p>
                </div>
                <a href="https://www.google.com/maps/place/Jamu+D'jamoe+Madiun/@-7.635457,111.5310661,889m/data=!3m2!1e3!4b1!4m6!3m5!1s0x2e79be94c7bef19b:0x2d581d8c40e4b01!8m2!3d-7.635457!4d111.533641!16s%2Fg%2F11f30kk08z?entry=ttu&g_ep=EgoyMDI1MTExMi4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="inline-flex items-center justify-center gap-2 bg-[#E6D793] text-[#1A3A24] font-bold py-3 md:py-4 px-6 rounded-xl hover:bg-white transition-all duration-300 shadow-[0_4px_20px_rgba(230,215,147,0.3)] hover:shadow-[0_6px_30px_rgba(230,215,147,0.5)] text-sm md:text-base active:scale-95 relative z-10">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> <?php echo e(__('Buka Google Maps')); ?>

                </a>
            </div>
            <div class="md:w-2/3 h-64 md:h-auto bg-gray-200 relative overflow-hidden group">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.442595011707!2d111.5310650748882!3d-7.635462892391696!2m3!1f0!2f0!3f0!3m2!i1024!i768!4f13.1!3m3!1m2!1s0x2e79be94c7bef19b%3A0x2d581d8c40e4b01!2sJamu%20D'jamoe%20Madiun!5e0!3m2!1sid!2sid!4v1727225131093!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="filter grayscale-[50%] group-hover:grayscale-0 transition-all duration-700 w-full h-full"></iframe>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // MODAL SCRIPT
        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const modalContent = document.getElementById('modalContent');
            if (!modal || !modalImg) return;
            modalImg.src = imageSrc;
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                if(modalContent) { modalContent.classList.remove('scale-95'); modalContent.classList.add('scale-100'); }
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const modalContent = document.getElementById('modalContent');
            if (!modal) return;
            modal.classList.add('opacity-0');
            if(modalContent) { modalContent.classList.remove('scale-100'); modalContent.classList.add('scale-95'); }
            setTimeout(() => {
                modal.classList.add('hidden');
                if(modalImg) modalImg.src = ''; 
            }, 300);
            document.body.style.overflow = 'auto';
        }

        // SWIPER & OBSERVER
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper !== 'undefined') {
                new Swiper('.hero-swiper', {
                    loop: true, effect: 'slide', speed: 1200,
                    autoplay: { delay: 5000, disableOnInteraction: false },
                    pagination: { el: '.swiper-pagination', clickable: true },
                    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                    parallax: true,
                });
            }
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('active');
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal-animation').forEach(el => observer.observe(el));
            
            document.addEventListener('keydown', function(event) {
                if (event.key === "Escape") closeModal();
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/welcome.blade.php ENDPATH**/ ?>