<div class="container mx-auto flex justify-between items-center bg-primary/30 backdrop-blur-lg rounded-full text-white p-2 shadow-lg">
        <a href="<?php echo e(route('home')); ?>" class="flex-shrink-0">
            <img src="<?php echo e(asset('gambar/logo_dj.png')); ?>" alt="Logo D'jamoe" class="h-10 ml-2">
        </a>
        
        <nav class="hidden md:flex items-center gap-6 font-semibold">
            <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'font-bold text-white' : 'text-accent/70 hover:text-white'); ?> transition-colors"><?php echo e(__('Beranda')); ?></a>
            <a href="<?php echo e(route('produk.index')); ?>" class="<?php echo e(request()->routeIs('produk.index') ? 'font-bold text-white' : 'text-accent/70 hover:text-white'); ?> transition-colors"><?php echo e(__('Produk')); ?></a>
            <a href="<?php echo e(route('aktivitas')); ?>" class="<?php echo e(request()->routeIs('aktivitas') ? 'font-bold text-white' : 'text-accent/70 hover:text-white'); ?> transition-colors"><?php echo e(__('Aktivitas')); ?></a>
            <a href="<?php echo e(route('outlet')); ?>" class="<?php echo e(request()->routeIs('outlet') ? 'font-bold text-white' : 'text-accent/70 hover:text-white'); ?> transition-colors"><?php echo e(__('Temukan Kami')); ?></a>
            <a href="<?php echo e(route('about')); ?>" class="<?php echo e(request()->routeIs('about') ? 'font-bold text-white' : 'text-accent/70 hover:text-white'); ?> transition-colors"><?php echo e(__('Tentang Kami')); ?></a>
        </nav>

        <div class="flex items-center gap-2">
            
            <div class="hidden md:flex items-center gap-3 ml-4 mr-2">
                <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $flagCode = ($localeCode == 'en') ? 'gb' : $localeCode; 
                    ?>
                    <a href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>"
                       hreflang="<?php echo e($localeCode); ?>"
                       rel="alternate"
                       title="<?php echo e($properties['native']); ?>"
                       class="transition-all duration-200 
                             <?php if($localeCode == LaravelLocalization::getCurrentLocale()): ?> 
                                 opacity-100 transform scale-110
                             <?php else: ?> 
                                 opacity-50 hover:opacity-100 hover:scale-105
                             <?php endif; ?>"
                    >
                        
                        <span class="fi fi-<?php echo e($flagCode); ?> flag-circle"></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <button id="mobile-menu-button" class="md:hidden p-2 rounded-full text-accent hover:bg-accent/10 transition-all mr-2">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </div>
</header>


<div id="mobile-menu" class="fixed top-20 right-4 z-[90] hidden transition-all duration-300">
    
    <div class="bg-primary/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-accent/20 overflow-hidden min-w-[280px] animate-slideDown">
        
        <div class="bg-gradient-to-r from-primary to-primary/80 px-5 py-3 border-b border-accent/20">
            <h3 class="text-accent font-bold text-sm tracking-wide uppercase"><?php echo e(__('Menu Navigasi')); ?></h3>
        </div>
        
        <div class="py-2">
            <a href="<?php echo e(route('home')); ?>" class="flex items-center px-5 py-3.5 <?php echo e(request()->routeIs('home') ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10'); ?> transition-all group border-b border-accent/10">
                <i data-lucide="home" class="h-5 w-5 mr-3 <?php echo e(request()->routeIs('home') ? 'text-white' : 'text-accent/70 group-hover:text-accent'); ?>"></i>
                <span><?php echo e(__('Beranda')); ?></span>
                <?php if(request()->routeIs('home')): ?>
                    <i data-lucide="chevron-right" class="h-4 w-4 ml-auto"></i>
                <?php endif; ?>
            </a>
            
            <a href="<?php echo e(route('produk.index')); ?>" class="flex items-center px-5 py-3.5 <?php echo e(request()->routeIs('produk.index') ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10'); ?> transition-all group border-b border-accent/10">
                <i data-lucide="package" class="h-5 w-5 mr-3 <?php echo e(request()->routeIs('produk.index') ? 'text-white' : 'text-accent/70 group-hover:text-accent'); ?>"></i>
                <span><?php echo e(__('Produk')); ?></span>
                <?php if(request()->routeIs('produk.index')): ?>
                    <i data-lucide="chevron-right" class="h-4 w-4 ml-auto"></i>
                <?php endif; ?>
            </a>
            
            <a href="<?php echo e(route('aktivitas')); ?>" class="flex items-center px-5 py-3.5 <?php echo e(request()->routeIs('aktivitas') ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10'); ?> transition-all group border-b border-accent/10">
                <i data-lucide="calendar-heart" class="h-5 w-5 mr-3 <?php echo e(request()->routeIs('aktivitas') ? 'text-white' : 'text-accent/70 group-hover:text-accent'); ?>"></i>
                <span><?php echo e(__('Aktivitas')); ?></span>
                <?php if(request()->routeIs('aktivitas')): ?>
                    <i data-lucide="chevron-right" class="h-4 w-4 ml-auto"></i>
                <?php endif; ?>
            </a>
            
            <a href="<?php echo e(route('outlet')); ?>" class="flex items-center px-5 py-3.5 <?php echo e(request()->routeIs('outlet') ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10'); ?> transition-all group border-b border-accent/10">
                <i data-lucide="map-pin" class="h-5 w-5 mr-3 <?php echo e(request()->routeIs('outlet') ? 'text-white' : 'text-accent/70 group-hover:text-accent'); ?>"></i>
                <span><?php echo e(__('Temukan Kami')); ?></span>
                <?php if(request()->routeIs('outlet')): ?>
                    <i data-lucide="chevron-right" class="h-4 w-4 ml-auto"></i>
                <?php endif; ?>
            </a>
            
            <a href="<?php echo e(route('about')); ?>" class="flex items-center px-5 py-3.5 <?php echo e(request()->routeIs('about') ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10'); ?> transition-all group">
                <i data-lucide="info" class="h-5 w-5 mr-3 <?php echo e(request()->routeIs('about') ? 'text-white' : 'text-accent/70 group-hover:text-accent'); ?>"></i>
                <span><?php echo e(__('Tentang Kami')); ?></span>
                <?php if(request()->routeIs('about')): ?>
                    <i data-lucide="chevron-right" class="h-4 w-4 ml-auto"></i>
                <?php endif; ?>
            </a>
        </div>

        
        <div class="px-5 py-3 border-t border-accent/20">
            <h4 class="text-accent/70 font-semibold text-xs tracking-wide mb-2 uppercase"><?php echo e(__('Pilih Bahasa')); ?></h4>
            <div class="flex items-center gap-3">
                <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $flagCode = ($localeCode == 'en') ? 'gb' : $localeCode;
                        $isActive = ($localeCode == LaravelLocalization::getCurrentLocale());
                    ?>
                    <a href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>"
                       hreflang="<?php echo e($localeCode); ?>"
                       rel="alternate"
                       class="flex items-center gap-2 p-2 rounded-lg transition-all w-1/2 justify-center
                              <?php echo e($isActive ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10'); ?>"
                    >
                        <span class="fi fi-<?php echo e($flagCode); ?> flag-circle"></span>
                        <span class="text-sm font-medium"><?php echo e($properties['native']); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>


<div id="mobile-menu-overlay" 
     class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[85] hidden md:hidden"
     onclick="document.getElementById('mobile-menu-button').click();">
</div><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/partials/navbar.blade.php ENDPATH**/ ?>