<header class="fixed top-4 left-0 right-0 z-50 px-4 transition-all duration-300 font-sans">
    
    
    <div class="container mx-auto max-w-6xl flex justify-between items-center 
                bg-[#051F1A]/80 backdrop-blur-md border border-white/10 
                rounded-full text-white py-3 px-6 shadow-2xl">
        
        
        <a href="<?php echo e(route('home')); ?>" class="flex-shrink-0 hover:opacity-80 transition-opacity">
            <img src="<?php echo e(asset('gambar/logo_dj.png')); ?>" alt="Logo D'jamoe" class="h-10 ml-2">
        </a>
        
        
        <nav class="hidden md:flex items-center gap-8 font-medium text-base tracking-wide">
            <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'text-accent font-bold' : 'text-gray-300 hover:text-white'); ?> transition-colors"><?php echo e(__('Beranda')); ?></a>
            <a href="<?php echo e(route('produk.index')); ?>" class="<?php echo e(request()->routeIs('produk.index') ? 'text-accent font-bold' : 'text-gray-300 hover:text-white'); ?> transition-colors"><?php echo e(__('Produk')); ?></a>
            <a href="<?php echo e(route('aktivitas')); ?>" class="<?php echo e(request()->routeIs('aktivitas') ? 'text-accent font-bold' : 'text-gray-300 hover:text-white'); ?> transition-colors"><?php echo e(__('Aktivitas')); ?></a>
            <a href="<?php echo e(route('outlet')); ?>" class="<?php echo e(request()->routeIs('outlet') ? 'text-accent font-bold' : 'text-gray-300 hover:text-white'); ?> transition-colors"><?php echo e(__('Temukan Kami')); ?></a>
            <a href="<?php echo e(route('about')); ?>" class="<?php echo e(request()->routeIs('about') ? 'text-accent font-bold' : 'text-gray-300 hover:text-white'); ?> transition-colors"><?php echo e(__('Tentang Kami')); ?></a>
        </nav>

        
        <div class="flex items-center gap-4">
            
            
            <div class="hidden md:flex items-center gap-3 ml-2 pl-4 h-6">
                <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($localeCode, ['id', 'en'])): ?> 
                        <?php $flagCode = ($localeCode == 'en') ? 'gb' : $localeCode; ?>
                        <a href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>"
                           class="transition-all duration-200 hover:scale-110 <?php echo e($localeCode == LaravelLocalization::getCurrentLocale() ? 'opacity-100 grayscale-0' : 'opacity-40 hover:opacity-100 grayscale'); ?>"
                           title="<?php echo e($properties['native']); ?>">
                            <span class="fi fi-<?php echo e($flagCode); ?> w-6 h-6 rounded-full shadow-sm block bg-cover flex-shrink-0"></span>
                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            
            <button id="mobile-menu-button" class="md:hidden p-2 rounded-full text-white hover:bg-white/10 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
            </button>
        </div>
    </div>
</header>


<div id="mobile-menu" class="fixed top-24 right-4 z-[90] hidden transition-all duration-300 origin-top-right font-sans">
    <div class="bg-[#051F1A]/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden w-[300px] animate-slideDown">
        
        
        <div class="bg-white/5 px-6 py-4 border-b border-white/5 flex justify-between items-center">
            
            <h3 class="text-white font-bold text-base tracking-widest uppercase">
                <?php echo e(__('MENU')); ?> 
            </h3>
        </div>
        
        
        <div class="flex flex-col py-2">
            <a href="<?php echo e(route('home')); ?>" class="px-6 py-3.5 text-sm font-medium flex justify-between items-center group transition-colors <?php echo e(request()->routeIs('home') ? 'text-accent bg-white/5' : 'text-gray-300 hover:text-white hover:bg-white/5'); ?>">
                <?php echo e(__('Beranda')); ?> <?php if(request()->routeIs('home')): ?> <div class="w-2 h-2 rounded-full bg-accent"></div> <?php endif; ?>
            </a>
            <a href="<?php echo e(route('produk.index')); ?>" class="px-6 py-3.5 text-sm font-medium flex justify-between items-center group transition-colors <?php echo e(request()->routeIs('produk.index') ? 'text-accent bg-white/5' : 'text-gray-300 hover:text-white hover:bg-white/5'); ?>">
                <?php echo e(__('Produk')); ?> <?php if(request()->routeIs('produk.index')): ?> <div class="w-2 h-2 rounded-full bg-accent"></div> <?php endif; ?>
            </a>
            <a href="<?php echo e(route('aktivitas')); ?>" class="px-6 py-3.5 text-sm font-medium flex justify-between items-center group transition-colors <?php echo e(request()->routeIs('aktivitas') ? 'text-accent bg-white/5' : 'text-gray-300 hover:text-white hover:bg-white/5'); ?>">
                <?php echo e(__('Aktivitas')); ?> <?php if(request()->routeIs('aktivitas')): ?> <div class="w-2 h-2 rounded-full bg-accent"></div> <?php endif; ?>
            </a>
            <a href="<?php echo e(route('outlet')); ?>" class="px-6 py-3.5 text-sm font-medium flex justify-between items-center group transition-colors <?php echo e(request()->routeIs('outlet') ? 'text-accent bg-white/5' : 'text-gray-300 hover:text-white hover:bg-white/5'); ?>">
                <?php echo e(__('Temukan Kami')); ?> <?php if(request()->routeIs('outlet')): ?> <div class="w-2 h-2 rounded-full bg-accent"></div> <?php endif; ?>
            </a>
            <a href="<?php echo e(route('about')); ?>" class="px-6 py-3.5 text-sm font-medium flex justify-between items-center group transition-colors <?php echo e(request()->routeIs('about') ? 'text-accent bg-white/5' : 'text-gray-300 hover:text-white hover:bg-white/5'); ?>">
                <?php echo e(__('Tentang Kami')); ?> <?php if(request()->routeIs('about')): ?> <div class="w-2 h-2 rounded-full bg-accent"></div> <?php endif; ?>
            </a>
            
            
            <div class="border-t border-white/5 mt-2 pt-4 px-6 grid grid-cols-2 gap-4 pb-4">
                <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($localeCode, ['id', 'en'])): ?> 
                        <?php 
                            $flagCode = ($localeCode == 'en') ? 'gb' : $localeCode; 
                            // Ubah agar selalu menampilkan "Indonesia" atau "English"
                            $langName = ($localeCode == 'id') ? 'Indonesia' : 'English'; 
                        ?>
                        
                        <a href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>"
                           class="flex items-center justify-center gap-2 py-2 px-2 rounded-lg transition-all text-sm
                                  <?php echo e($localeCode == LaravelLocalization::getCurrentLocale() 
                                     ? 'bg-accent/20 text-accent font-semibold border border-accent/40 scale-[1.02]' 
                                     : 'bg-white/5 text-gray-300 hover:bg-white/10'); ?>">
                           
                            
                            <span class="fi fi-<?php echo e($flagCode); ?> w-6 h-6 rounded-full block bg-cover flex-shrink-0"></span>
                            
                            
                            <span class="font-medium whitespace-nowrap overflow-hidden text-ellipsis">
                                <?php echo e($langName); ?>

                            </span>
                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
        </div>
    </div>
</div>

<div id="mobile-menu-overlay" 
     class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[85] hidden md:hidden transition-opacity duration-300"
     onclick="toggleMobileMenu()">
</div>


<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-menu-overlay');
        if (menu && overlay) {
            menu.classList.toggle('hidden');
            overlay.classList.toggle('hidden');
        }
    }

    // Menggunakan Event Listener dengan Pengecekan Null (Anti Error Console)
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-button');
        if(btn) {
            // Hapus listener lama jika ada (trik clone)
            const newBtn = btn.cloneNode(true);
            btn.parentNode.replaceChild(newBtn, btn);
            
            newBtn.addEventListener('click', toggleMobileMenu);
        }
    });
</script><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/partials/navbar.blade.php ENDPATH**/ ?>