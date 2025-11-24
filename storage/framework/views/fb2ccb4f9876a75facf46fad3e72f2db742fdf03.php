<?php $__env->startSection('title', __('Beranda') . " - D'jamoe"); ?>
<?php $__env->startSection('content'); ?>


<section class="relative">
    <div class="swiper-container hero-swiper">
        <div class="swiper-wrapper">
            <?php $__empty_1 = true; $__currentLoopData = $flyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="swiper-slide" style="background-image: url('<?php echo e(asset('storage/' . $flyer->image_url)); ?>');"></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="swiper-slide" style="background-image: url('<?php echo e(asset('gambar/gambar1.jpg')); ?>');"></div>
            <?php endif; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>


<section class="py-12 md:py-20"> 
    <div class="container mx-auto px-4 text-center">
        <div class="reveal-animation">
            
            <h2 class="text-3xl md:text-5xl font-serif font-bold text-accent"><?php echo e(__('Selamat Datang di D\'jamoe')); ?></h2>
            <p class="mt-4 max-w-3xl mx-auto text-light-text/80 text-base md:text-lg">
                <?php echo e(__('Kami mengajak Anda merasakan kehangatan tradisi dan kebaikan alam dalam setiap tegukan. Temukan kembali warisan kesehatan khas Madiun yang kami sajikan tulus dari hati.')); ?>

            </p>
        </div>
    </div>
</section>


<section class="py-12 md:py-20 bg-zona-b">
    <div class="container mx-auto px-4">
        <div class="flex justify-center mb-8 md:mb-12"><i data-lucide="leaf" class="w-8 h-8 text-accent/50 reveal-animation"></i></div>
        <div class="text-center mb-8 md:mb-12">
            <h2 class="text-3xl md:text-5xl font-serif font-bold reveal-animation"><?php echo e(__('Produk Unggulan')); ?></h2>
            <p class="text-gray-300 mt-2 reveal-animation text-sm md:text-base"><?php echo e(__('Pilihan favorit untuk menjaga kesehatan dan kebugaran Anda.')); ?></p>
        </div>
        <div class="product-grid-container reveal-animation">
            
            
            
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-8"> 
                <?php $__empty_1 = true; $__currentLoopData = $featuredProducts->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('produk.index')); ?>" 
                       class="product-card bg-[#1a3a24] rounded-xl md:rounded-2xl shadow-lg h-full flex flex-col group overflow-hidden">
                        
                        
                        <img src="<?php echo e(asset('storage/' . $product->image_url)); ?>" alt="<?php echo e($product->product_name); ?>" 
                             class="w-full h-40 md:h-80 object-cover" 
                             loading="lazy" decoding="async">
                        
                        <div class="p-3 md:p-6 text-center flex flex-col flex-grow">
                            
                            <h3 class="text-sm md:text-xl font-serif font-bold mb-2 text-[#FBF8ED] line-clamp-2"><?php echo e($product->product_name); ?></h3>
                            <div class="flex-grow"></div>
                            <span class="mt-2 md:mt-4 text-[#E6D793] font-semibold text-xs md:text-base flex items-center justify-center gap-1">
                                <?php echo e(__('Lihat Detail')); ?> 
                                <i data-lucide="arrow-right" class="w-3 h-3 md:w-4 md:h-4 transition-transform group-hover:translate-x-1"></i>
                            </span>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full text-center text-gray-400"><?php echo e(__('Belum ada produk unggulan.')); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<section class="pt-0 pb-12 md:pb-20 bg-zona-b">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-8 md:gap-12 items-center">
        
        
        
        
        
        <div class="relative w-full h-64 md:h-auto overflow-hidden rounded-2xl shadow-xl reveal-animation">
             <img src="<?php echo e(asset('gambar\halal.jpg')); ?>" alt="Proses Pembuatan D'jamoe" 
             class="w-full h-full object-cover" 
             loading="lazy" decoding="async">
        </div>

        <div class="reveal-animation text-center md:text-left">
            <h2 class="text-3xl md:text-5xl font-serif font-bold text-[#E6D793]"><?php echo e(__('Sertifikasi Halal')); ?></h2>
            <p class="mt-4 text-[#E6D793]/70 text-sm md:text-base"><?php echo e(__('D\'jamoe lahir dari kecintaan untuk melestarikan resep warisan keluarga yang telah terbukti khasiatnya selama beberapa generasi. Kami percaya bahwa alam menyediakan semua yang kita butuhkan untuk hidup sehat.')); ?></p>
            <a href="<?php echo e(route('about')); ?>" class="mt-6 md:mt-8 inline-block bg-[#E6D793] text-[#154424] font-bold py-2 px-6 md:py-3 md:px-8 text-sm md:text-base rounded-full hover:bg-opacity-90 transition-transform hover:scale-105"><?php echo e(__('Baca Kisah Lengkap')); ?></a>
        </div>
    </div>
</section>


<section class="py-12 md:py-20">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-5xl font-serif font-bold reveal-animation"><?php echo e(__('Kata Mereka')); ?></h2>
        <div class="mt-8 md:mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <div class="bg-[#1a3a24] p-6 md:p-8 rounded-2xl shadow-lg reveal-animation">
                <p class="text-[#E6D793]/80 italic text-sm md:text-base"><?php echo e(__('"Beras Kencurnya juara! Badan langsung terasa segar dan enteng setelah minum. Rasanya pas, tidak terlalu manis."')); ?></p>
                <p class="mt-4 font-bold font-serif text-base md:text-lg text-[#FBF8ED]"><?php echo e(__('- Anisa, Karyawan Swasta')); ?></p>
            </div>
            <div class="bg-[#1a3a24] p-6 md:p-8 rounded-2xl shadow-lg reveal-animation">
                <p class="text-[#E6D793]/80 italic text-sm md:text-base"><?php echo e(__('"Suka banget sama Kunir Asemnya. Selalu sedia di kulkas untuk melancarkan pencernaan. Kemasannya juga praktis."')); ?></p>
                <p class="mt-4 font-bold font-serif text-base md:text-lg text-[#FBF8ED]"><?php echo e(__('- Budi Santoso, Atlet')); ?></p>
            </div>
            <div class="bg-[#1a3a24] p-6 md:p-8 rounded-2xl shadow-lg reveal-animation">
                <p class="text-[#E6D793]/80 italic text-sm md:text-base"><?php echo e(__('"Wedang Uwuh dari D\'jamoe ini favorit keluarga. Tinggal seduh, langsung hangat dan rileks. Rempahnya terasa asli."')); ?></p>
                <p class="mt-4 font-bold font-serif text-base md:text-lg text-[#FBF8ED]"><?php echo e(__('- Citra Lestari, Ibu Rumah Tangga')); ?></p>
            </div>
        </div>
    </div>
</section>


<section class="py-12 md:py-20">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-5xl font-serif font-bold reveal-animation"><?php echo e(__('Dipercaya Oleh')); ?></h2>
        <p class="text-light-text/70 mt-2 mb-8 md:mb-12 reveal-animation text-sm md:text-base" style="transition-delay: 100ms;"><?php echo e(__('Kami bangga dapat melayani dan bekerja sama dengan berbagai institusi ternama.')); ?></p>
        
        
        <div class="relative h-64 md:h-96 grid grid-cols-3 gap-4 md:gap-8 overflow-hidden client-logo-container">
            <?php $renderLogo = function($src, $alt, $class = 'h-12 md:h-16') { echo '<img src="' . asset($src) . '" alt="' . $alt . '" class="' . $class . ' max-w-full filter grayscale invert object-contain" loading="lazy" decoding="async">'; }; ?>
            <div class="flex flex-col gap-6 md:gap-8"><div class="animate-scroll-up flex flex-col items-center gap-6 md:gap-8"><?php echo e($renderLogo('gambar/1_ASTON_REV.webp', 'Logo Aston Madiun')); ?> <?php echo e($renderLogo('gambar/1_BANK JATIM_REV.webp', 'Logo Bank Jatim')); ?> <?php echo e($renderLogo('gambar/1_DPRD_REV.webp', 'Logo DPRD', 'h-14 md:h-20')); ?> <?php echo e($renderLogo('gambar/1_IMS_REV.webp', 'Logo IMS')); ?> <?php echo e($renderLogo('gambar/1_ASTON_REV.webp', 'Logo Aston')); ?> <?php echo e($renderLogo('gambar/1_BANK JATIM_REV.webp', 'Logo Bank Jatim')); ?></div></div>
            <div class="flex flex-col gap-6 md:gap-8"><div class="animate-scroll-down flex flex-col items-center gap-6 md:gap-8"><?php echo e($renderLogo('gambar/1_INKA_REV.webp', 'Logo INKA', 'h-10 md:h-12')); ?> <?php echo e($renderLogo('gambar/1_JNK_REV.webp', 'Logo JNK')); ?> <?php echo e($renderLogo('gambar/1_LANUD_REV.webp', 'Logo Lanud', 'h-14 md:h-20')); ?> <?php echo e($renderLogo('gambar/1_INKA_REV.webp', 'Logo INKA', 'h-10 md:h-12')); ?> <?php echo e($renderLogo('gambar/1_JNK_REV.webp', 'Logo JNK')); ?></div></div>
            <div class="flex flex-col gap-6 md:gap-8"><div class="animate-scroll-up flex flex-col items-center gap-6 md:gap-8"><?php echo e($renderLogo('gambar/1_LOGO UNIPMA_REV.webp', 'Logo UNIPMA', 'h-14 md:h-20')); ?> <?php echo e($renderLogo('gambar/1_PEMKOT_REV.webp', 'Logo Pemkot', 'h-14 md:h-20')); ?> <?php echo e($renderLogo('gambar/1_INKA_REV.webp', 'Logo INKA', 'h-10 md:h-12')); ?> <?php echo e($renderLogo('gambar/1_LOGO UNIPMA_REV.webp', 'Logo UNIPMA', 'h-14 md:h-20')); ?> <?php echo e($renderLogo('gambar/1_PEMKOT_REV.webp', 'Logo Pemkot', 'h-14 md:h-20')); ?></div></div>
        </div>
    </div>
</section>


<section id="outlet" class="py-12 md:py-20 bg-zona-b">
    <div class="container mx-auto px-4">
    <div class="text-center"><h2 class="text-3xl md:text-5xl font-serif font-bold reveal-animation text-accent"><?php echo e(__('Temukan Kami di Madiun')); ?></h2></div>
    
    
    
    
    <div class="mt-8 bg-dark-bg p-6 rounded-lg shadow-lg flex flex-col md:flex-row justify-between items-center gap-4 reveal-animation" style="transition-delay: 100ms;">
        
        
        <div class="text-center md:text-left">
            <p class="font-semibold text-base md:text-lg text-light-text"><?php echo e(__('Jamu D\'jamoe Madiun')); ?></p>
            <p class="text-accent/70 text-sm md:text-base">Jl. Ranumenggalan No.41, Mojorejo, Kec. Kartoharjo, <br>Kota Madiun, Jawa Timur 63119</p>
        </div>
        
        <a href="https://www.google.com/maps/place/Jamu+D'jamoe+Madiun/@-7.635457,111.5310661,889m/data=!3m2!1e3!4b1!4m6!3m5!1s0x2e79be94c7bef19b:0x2d581d8c40e4b01!8m2!3d-7.635457!4d111.533641!16s%2Fg%2F11f30kk08z?entry=ttu&g_ep=EgoyMDI1MTExMi4wIKXMDSoASAFQAw%3D%3D" target="_blank" 
           class="mt-4 md:mt-0 bg-accent text-primary font-bold py-2 px-6 md:py-3 md:px-6 rounded-full text-sm md:text-base transition-transform duration-300 hover:scale-105 inline-block">
           <?php echo e(__('Lihat Rute')); ?>

        </a>
    </div>
</div>
        
        
        
        
        
        <div class="mt-4 rounded-lg overflow-hidden shadow-2xl map-container border-4 border-primary/50 dark:border-accent/20 reveal-animation h-64 md:h-[450px]" style="transition-delay: 200ms;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.442595011707!2d111.5310650748882!3d-7.635462892391696!2m3!1f0!2f0!3f0!3m2!i1024!i768!4f13.1!3m3!1m2!1s0x2e79be94c7bef19b%3A0x2d581d8c40e4b01!2sJamu%20D'jamoe%20Madiun!5e0!3m2!1sid!2sid!4v1727225131093!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/welcome.blade.php ENDPATH**/ ?>