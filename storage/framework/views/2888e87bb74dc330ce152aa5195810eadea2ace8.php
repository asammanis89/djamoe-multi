
<?php $__env->startSection('title', __('Temukan Kami') . " - D'jamoe"); ?>

<?php $__env->startPush('styles'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/pages/outlet.css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/pages/outlet.js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>



<section class="relative pt-20 pb-8 md:pt-32 md:pb-12 bg-elegant-activity overflow-hidden">
    
    <div class="absolute -left-20 top-20 w-96 h-96 bg-[#E6D793] rounded-full blur-[120px] opacity-10 pointer-events-none animate-pulse-slow"></div>
    <div class="absolute -right-20 bottom-20 w-96 h-96 bg-[#E6D793] rounded-full blur-[120px] opacity-10 pointer-events-none animate-pulse-slow" style="animation-delay: 2s;"></div>
    
    <div class="container mx-auto px-4 text-center relative z-10">
        <span class="inline-block px-6 py-2 bg-[#E6D793]/20 text-[#E6D793] rounded-full text-xs font-bold uppercase tracking-widest mb-6 reveal-animation border border-[#E6D793]/30">
            <?php echo e(__('Jaringan Distribusi')); ?>

        </span>

        <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#E6D793] mb-6 reveal-animation leading-tight">
            <?php echo e(__('Temukan Kami')); ?>

        </h1>
        <p class="text-[#FBF8ED]/80 text-base md:text-xl max-w-3xl mx-auto leading-relaxed reveal-animation" style="transition-delay: 100ms;">
            <?php echo e(__('Temukan kami di seluruh wilayah.')); ?>

        </p>
    </div>
</section>



<section class="pt-8 pb-16 md:pt-12 md:pb-24 bg-mint-activity relative overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-20 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $groupedLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $locations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
                
                <?php $modalId = 'modal-' . \Illuminate\Support\Str::slug($name); ?>

                <div class="outlet-card p-4 md:p-8 group reveal-animation flex flex-col h-full relative transition-all duration-300 hover:bg-[#1A3A24] hover:border-[#E6D793]/50 hover:-translate-y-2 hover:shadow-2xl">
                    
                    
                    <div class="mb-3 md:mb-6 pb-2 md:pb-4 border-b border-gray-100 group-hover:border-[#E6D793]/30 transition-colors">
                        <h3 class="text-sm md:text-2xl font-serif font-bold leading-tight text-[#1A3A24] group-hover:text-[#E6D793] transition-colors"><?php echo e($name); ?></h3>
                    </div>

                    <?php if($locations->count() > 1): ?>
                        
                        <div class="absolute top-4 right-4 bg-[#E6D793] text-[#1A3A24] text-[10px] md:text-xs font-bold px-2 py-1 rounded-full shadow-sm">
                            <?php echo e($locations->count()); ?> Cabang
                        </div>

                        <div class="flex-grow space-y-2">
                            <p class="text-xs md:text-sm text-gray-500 italic group-hover:text-white/60 transition-colors">
                                Mitra resmi kami tersedia di <?php echo e($locations->count()); ?> titik lokasi.
                            </p>
                            
                            
                            <div class="flex -space-x-2 overflow-hidden pt-2">
                                <div class="w-8 h-8 rounded-full bg-gray-100 border-2 border-white flex items-center justify-center text-xs">📍</div>
                                <div class="w-8 h-8 rounded-full bg-gray-100 border-2 border-white flex items-center justify-center text-xs">📍</div>
                                <?php if($locations->count() > 2): ?>
                                <div class="w-8 h-8 rounded-full bg-[#1A3A24] border-2 border-white flex items-center justify-center text-xs text-[#E6D793] font-bold">
                                    +<?php echo e($locations->count() - 2); ?>

                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="mt-4 md:mt-8 relative z-10">
                            <button type="button" 
                               data-modal-target="<?php echo e($modalId); ?>"
                               class="btn-direction w-full text-center py-2 md:py-3 rounded-lg md:rounded-xl text-[10px] md:text-sm font-bold tracking-wide cursor-pointer border border-[#1A3A24]/10 bg-gray-50 text-[#1A3A24] group-hover:bg-[#E6D793] group-hover:text-[#1A3A24] group-hover:shadow-lg group-hover:shadow-yellow-800/20 transition-all duration-300">
                                <i data-lucide="list" class="w-3 h-3 md:w-4 md:h-4 inline-block mr-1"></i> 
                                <?php echo e(__('Lihat Daftar Lokasi')); ?>

                            </button>
                        </div>

                    <?php else: ?>
                        
                        <?php $location = $locations->first(); ?>
                        
                        <div class="space-y-3 md:space-y-5 flex-grow relative z-10">
                            <div class="flex items-start gap-2 md:gap-4">
                                <div class="icon-wrapper w-6 h-6 md:w-10 md:h-10 rounded-full flex items-center justify-center flex-shrink-0 shadow-sm bg-gray-100 text-[#1A3A24] group-hover:bg-[#E6D793] group-hover:scale-110 transition-all duration-300">
                                    <i data-lucide="map-pin" class="w-3 h-3 md:w-5 md:h-5"></i>
                                </div>
                                <span class="text-content text-[10px] md:text-base leading-relaxed text-gray-600 group-hover:text-[#FBF8ED] transition-colors">
                                    <?php echo e($location->address); ?>

                                </span>
                            </div>
                            <?php if($location->phone_number): ?>
                            <div class="flex items-center gap-2 md:gap-4">
                                <div class="icon-wrapper w-6 h-6 md:w-10 md:h-10 rounded-full flex items-center justify-center flex-shrink-0 shadow-sm bg-gray-100 text-[#1A3A24] group-hover:bg-[#E6D793] group-hover:scale-110 transition-all duration-300">
                                    <i data-lucide="phone" class="w-3 h-3 md:w-5 md:h-5"></i>
                                </div>
                                <span class="text-content text-[10px] md:text-base text-gray-600 group-hover:text-[#FBF8ED] transition-colors">
                                    <?php echo e($location->phone_number); ?>

                                </span>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mt-4 md:mt-8 relative z-10">
                            <a href="<?php echo e($location->google_maps_url); ?>" target="_blank" 
                               class="btn-direction block w-full text-center py-2 md:py-3 rounded-lg md:rounded-xl text-[10px] md:text-sm transform active:scale-95 transition-transform font-bold tracking-wide bg-gray-100 text-[#1A3A24] group-hover:bg-[#E6D793] group-hover:shadow-lg group-hover:shadow-yellow-800/20">
                                <i data-lucide="navigation" class="w-3 h-3 md:w-4 md:h-4 inline-block mr-1 -mt-0.5"></i> 
                                <?php echo e(__('Arah')); ?>

                            </a>
                        </div>
                    <?php endif; ?>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-500"><?php echo e(__('Belum ada data lokasi.')); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php $__currentLoopData = $groupedLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $locations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($locations->count() > 1): ?>
        <?php $modalId = 'modal-' . \Illuminate\Support\Str::slug($name); ?>

        
        <div id="<?php echo e($modalId); ?>" 
             class="modal-overlay fixed inset-0 bg-black/60 z-[9999] flex items-center justify-center p-4 backdrop-blur-sm transition-opacity duration-300 ease-in-out opacity-0 pointer-events-none">
            
            
            <div class="modal-content bg-white rounded-2xl shadow-2xl border border-[#E6D793] w-full max-w-lg max-h-[80vh] flex flex-col overflow-hidden transform transition-all duration-300 ease-in-out scale-95">
                
                
                <div class="bg-[#1A3A24] px-6 py-4 flex justify-between items-center flex-shrink-0">
                    <h3 class="text-lg font-serif font-bold text-[#E6D793]">Cabang <?php echo e($name); ?></h3>
                    <button type="button" data-modal-close class="text-white hover:text-[#E6D793] focus:outline-none">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                
                <div class="px-6 py-4 overflow-y-auto bg-[#FBF8ED] flex-grow">
                    <ul class="space-y-3">
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="group/item bg-white p-3 rounded-lg border border-gray-100 hover:border-[#E6D793] transition-all duration-300 shadow-sm flex justify-between items-center transform hover:-translate-y-1 hover:shadow-md">
                            <div>
                                <p class="text-sm text-gray-800 font-medium"><?php echo e($loc->address); ?></p>
                                <?php if($loc->phone_number): ?>
                                    <p class="text-xs text-gray-500 mt-1"><i data-lucide="phone" class="w-3 h-3 inline mr-1.5"></i><?php echo e($loc->phone_number); ?></p>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo e($loc->google_maps_url); ?>" target="_blank" class="flex-shrink-0 ml-3 bg-gray-50 group-hover/item:bg-[#E6D793] text-[#1A3A24] p-2 rounded-full transition-colors duration-300">
                                <i data-lucide="navigation" class="w-4 h-4"></i>
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

            </div>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/outlet.blade.php ENDPATH**/ ?>