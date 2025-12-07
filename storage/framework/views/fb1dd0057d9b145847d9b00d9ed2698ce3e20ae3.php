
<?php $__env->startSection('title', __('Aktivitas & Wawasan') . " - D'jamoe"); ?>

<?php $__env->startPush('styles'); ?>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/pages/aktivitas.css', 'resources/js/pages/aktivitas-modal.js']); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>



<section class="relative pt-20 pb-8 md:pt-32 md:pb-12 bg-elegant-activity overflow-hidden">
    
    <div class="absolute -left-20 top-20 w-96 h-96 bg-[#E6D793] rounded-full blur-[120px] opacity-10 pointer-events-none animate-pulse-slow"></div>
    <div class="absolute -right-20 bottom-20 w-96 h-96 bg-[#E6D793] rounded-full blur-[120px] opacity-10 pointer-events-none animate-pulse-slow" style="animation-delay: 2s;"></div>
    
    
    <div class="floating-ornament ornament-1"></div>
    <div class="floating-ornament ornament-2"></div>

    <div class="container mx-auto px-4 text-center relative z-10">
        <span class="inline-block px-6 py-2 bg-[#E6D793]/20 text-[#E6D793] rounded-full text-xs font-bold uppercase tracking-widest mb-6 border border-[#E6D793]/30 reveal-animation">
            <?php echo e(__('Berbagi Pengalaman')); ?>

        </span>

        <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#E6D793] mb-6 reveal-animation leading-tight" style="text-shadow: 0 4px 20px rgba(0,0,0,0.8);">
            <?php echo e(__('Aktivitas & Wawasan')); ?>

        </h1>
        <p class="text-[#FBF8ED]/80 text-base md:text-xl max-w-3xl mx-auto leading-relaxed reveal-animation" style="transition-delay: 100ms;">
            <?php echo e(__('Lebih dari sekadar produk, kami berbagi pengalaman dan pengetahuan tentang Jamu')); ?>

        </p>
    </div>
</section>



<section class="pt-8 pb-16 md:pt-12 md:pb-24 bg-mint-activity relative overflow-hidden">
    
    

    <div class="container mx-auto px-4 space-y-12 md:space-y-20 relative z-10">
        
        
        <div>
            
            <div class="bg-dark-card-activity rounded-2xl p-6 md:p-12 reveal-animation">
                <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">
                    <div>
                        <img src="<?php echo e(asset('gambar/gambar22.jpeg')); ?>" alt="Wawasan tentang Jamu" class="rounded-lg shadow-lg mb-6 w-full object-cover aspect-video border border-opacity-20 border-[#E6D793]" loading="lazy">
                        
                        <h3 class="text-2xl md:text-3xl font-serif font-bold text-[#E6D793]"><?php echo e(__('Selami Lebih Dalam Dunia Jamu')); ?></h3>
                        
                        <p class="mt-4 text-sm md:text-base text-[#FBF8ED]/90 leading-relaxed"><?php echo e(__('Kami percaya edukasi adalah kunci untuk melestarikan warisan budaya. Temukan berbagai artikel menarik dan video dokumenter perjalanan kami.')); ?></p>    
                    </div>
                    <div class="space-y-8">
                        <div>
                            <h4 class="text-xl md:text-2xl font-serif font-semibold text-[#E6D793] border-b border-[#E6D793]/30 pb-2 mb-4"><?php echo e(__('Artikel Pilihan')); ?></h4>
                            <ul class="space-y-3">
                                <li><a href="#" class="flex items-center gap-3 text-sm md:text-base text-[#FBF8ED]/80 hover:text-[#E6D793] transition-colors group"><i data-lucide="book-open" class="w-5 h-5 text-[#E6D793] group-hover:scale-110 transition-transform"></i><?php echo e(__('Manfaat Kunyit untuk Kesehatan')); ?></a></li>
                                <li><a href="#" class="flex items-center gap-3 text-sm md:text-base text-[#FBF8ED]/80 hover:text-[#E6D793] transition-colors group"><i data-lucide="book-open" class="w-5 h-5 text-[#E6D793] group-hover:scale-110 transition-transform"></i><?php echo e(__('Sejarah Jamu Gendong')); ?></a></li>
                                <li><a href="#" class="flex items-center gap-3 text-sm md:text-base text-[#FBF8ED]/80 hover:text-[#E6D793] transition-colors group"><i data-lucide="book-open" class="w-5 h-5 text-[#E6D793] group-hover:scale-110 transition-transform"></i><?php echo e(__('5 Rempah Dapur Wajib Punya')); ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-xl md:text-2xl font-serif font-semibold text-[#E6D793] border-b border-[#E6D793]/30 pb-2 mb-4"><?php echo e(__('Tonton Kami di YouTube')); ?></h4>
                            <ul class="space-y-3">
                                <li><a href="#" class="flex items-center gap-3 text-sm md:text-base text-[#FBF8ED]/80 hover:text-[#E6D793] transition-colors group"><i data-lucide="youtube" class="w-5 h-5 text-[#E6D793] group-hover:scale-110 transition-transform"></i><?php echo e(__('Proses Pembuatan Jamu Modern')); ?></a></li>
                                <li><a href="#" class="flex items-center gap-3 text-sm md:text-base text-[#FBF8ED]/80 hover:text-[#E6D793] transition-colors group"><i data-lucide="youtube" class="w-5 h-5 text-[#E6D793] group-hover:scale-110 transition-transform"></i><?php echo e(__('Wawancara dengan Petani Jahe')); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div>
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-5xl font-serif font-bold text-[#1A3A24] reveal-animation"><?php echo e(__('Pilihan Pengalaman Unik')); ?></h2>
                <div class="w-20 h-1.5 bg-gradient-to-r from-transparent via-[#E6D793] to-transparent mx-auto mt-6 rounded-full reveal-animation"></div>
                <p class="mt-4 text-base md:text-lg text-[#1A3A24]/70 max-w-2xl mx-auto reveal-animation" style="transition-delay: 100ms;"><?php echo e(__('Selami dunia jamu lebih dalam melalui berbagai kegiatan dan wawasan kami.')); ?></p>
            </div>
            
            
            <div class="grid grid-cols-2 gap-4 md:gap-8 lg:grid-cols-4">
                <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div 
                    data-title="<?php echo e($article->title); ?>" 
                    data-image="<?php echo e(asset('storage/' . $article->image)); ?>" 
                    data-description="<?php echo e($article->description); ?>" 
                    class="activity-card group cursor-pointer overflow-hidden reveal-animation" 
                    style="transition-delay: <?php echo e($loop->iteration * 100); ?>ms;">
                    
                    
                    <div class="relative h-48 md:h-64 overflow-hidden bg-gray-100">
                        <img src="<?php echo e(asset('storage/' . $article->image)); ?>" 
                            alt="<?php echo e($article->subtitle); ?>" 
                            class="w-full h-full object-cover activity-image transition-transform duration-700 group-hover:scale-110 group-hover:rotate-1" 
                            loading="lazy" 
                            onerror="this.src='https://placehold.co/500x500/102b19/E6D793?text=<?php echo e(urlencode($article->subtitle)); ?>'">
                        
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1A3A24] via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300"></div>
                        
                        
                        <div class="absolute bottom-0 left-0 p-4 w-full">
                            <h2 class="text-sm md:text-lg font-serif font-bold text-[#E6D793] line-clamp-2 drop-shadow-md"><?php echo e($article->subtitle); ?></h2>
                        </div>
                    </div>
                    
                    
                    <div class="p-4 md:p-6 flex flex-col flex-grow bg-white relative">
                        <h3 class="font-serif text-lg md:text-xl font-bold activity-title line-clamp-2 mb-2 text-[#1A3A24] group-hover:text-[#E6D793] transition-colors"><?php echo e($article->title); ?></h3>
                        
                        <div class="h-16 overflow-hidden mb-4">
                            <p class="text-[#1A3A24]/70 text-sm leading-relaxed line-clamp-3"><?php echo e(Str::limit($article->description, 100)); ?></p>
                        </div>
                        
                        <div class="mt-auto">
                            <button class="detail-btn-activity w-full inline-flex items-center justify-center gap-2 py-3 rounded-lg font-bold text-xs uppercase tracking-wider shadow-sm transition-all duration-300">
                                <span><?php echo e(__('Lihat Detail')); ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-12">
                    <div class="bg-white rounded-2xl shadow-soft p-8 max-w-md mx-auto border border-gray-100">
                        <i data-lucide="calendar" class="w-12 h-12 mx-auto mb-4 text-[#1A3A24]/30"></i>
                        <p class="text-[#1A3A24]/70"><?php echo e(__('Belum ada aktivitas yang ditambahkan.')); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<div id="activity-modal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[100] flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
    
    
    <div class="modal-content bg-batik-modal w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl relative scale-95 opacity-0 transition-transform duration-300 border border-[#E6D793]/40">
        
        
        <button class="close-modal absolute top-4 right-4 z-20 w-10 h-10 bg-[#1A3A24]/80 backdrop-blur-md rounded-full flex items-center justify-center text-[#E6D793] hover:bg-[#E6D793] hover:text-[#1A3A24] border-2 border-white/20 hover:scale-110 hover:rotate-90 transition-all shadow-lg">
            <i data-lucide="x" class="w-5 h-5 font-bold"></i>
        </button>
        
        
        <div class="relative w-full h-64 md:h-80 bg-gray-100">
            
            <img id="modal-image" src="" alt="Gambar" class="w-full h-full object-cover rounded-t-3xl">
            
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-80 rounded-t-3xl pointer-events-none"></div>
        </div>
        
        
        <div class="p-6 md:p-10 relative">
            
            <span class="inline-block px-3 py-1 mb-3 text-[10px] tracking-widest font-bold uppercase text-[#1A3A24] bg-[#E6D793] rounded-full shadow-sm">
                <?php echo e(__('Aktivitas')); ?>

            </span>

            
            <h2 id="modal-title" class="text-2xl md:text-4xl font-serif font-bold text-[#1A3A24] mb-4 leading-tight"></h2>
            
            
            <div class="w-16 h-1 bg-[#E6D793] rounded-full mb-6"></div>

            
            <div id="modal-description" class="text-base text-[#1A3A24]/80 leading-relaxed text-justify space-y-4 font-light"></div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // Memastikan ikon dirender setelah DOM siap
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/aktivitas.blade.php ENDPATH**/ ?>