
<?php $__env->startSection('title', __('Temukan Kami') . " - D'jamoe"); ?>
<?php $__env->startSection('content'); ?>


<section class="relative h-[60vh] bg-cover bg-center flex items-center justify-center text-center text-white" 
         style="background-image: linear-gradient(rgba(10, 28, 17, 0.7), rgba(10, 28, 17, 0.8)), url('<?php echo e(asset('gambar/gambar22.jpeg')); ?>');">
    <div class="reveal-animation">
        <h1 class="text-4xl md:text-7xl font-serif font-bold text-accent"><?php echo e(__('Temukan Kami')); ?></h1>
    </div>
</section>


<section class="py-12 md:py-24">
    <div class="container mx-auto px-4">

        
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <div class="bg-dark-card p-4 md:p-6 rounded-2xl shadow-lg flex flex-col reveal-animation" style="transition-delay: <?php echo e($loop->iteration * 100); ?>ms;">
                
                
                <h3 class="text-lg md:text-xl font-serif font-bold text-accent mb-3"><?php echo e($location->name); ?></h3>
                
                
                <div class="space-y-3 text-sm flex-grow">
                    <p class="flex items-start gap-3 text-light-text/80">
                        <i data-lucide="map-pin" class="w-4 h-4 mt-1 text-accent/80 flex-shrink-0"></i>
                        <span><?php echo e($location->address); ?></span>
                    </p>
                    <?php if($location->phone_number): ?>
                    <p class="flex items-center gap-3 text-light-text/80">
                        <i data-lucide="message-circle" class="w-4 h-4 text-accent/80 flex-shrink-0"></i>
                        <span><?php echo e($location->phone_number); ?></span>
                    </p>
                    <?php endif; ?>
                </div>
                
                
                <?php if($location->google_maps_url): ?>
                <a href="<?php echo e($location->google_maps_url); ?>" target="_blank" 
                   class="mt-5 w-full text-center bg-primary/80 text-accent py-2 px-4 rounded-full 
                          hover:bg-accent hover:text-primary 
                          active:bg-accent active:text-primary 
                          transition-colors duration-300 font-semibold 
                          text-xs md:text-sm"> 
                    <?php echo e(__('Petunjuk Arah')); ?>

                </a>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-12 md:py-16 text-accent/70">
                <p><?php echo e(__('Belum ada lokasi mitra yang ditambahkan saat ini.')); ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/outlet.blade.php ENDPATH**/ ?>