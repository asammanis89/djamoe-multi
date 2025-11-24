
<?php $__env->startSection('title', __('Produk') . ' - D\'jamoe'); ?>
<?php $__env->startSection('content'); ?>
<section id="produk" class="py-24">
    <div class="container mx-auto px-4">
        
        <div id="category-view">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-accent reveal-animation"><?php echo e(__('Katalog Produk')); ?></h2>
                <p class="text-light-text/70 mt-4 max-w-2xl mx-auto reveal-animation" style="transition-delay: 100ms;">
                    <?php echo e(__('Pilih kategori untuk menemukan produk yang paling sesuai.')); ?>

                </p>
            </div>
            <div id="category-grid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-8">
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="category-card-container reveal-animation" style="transition-delay: <?php echo e($index * 50); ?>ms;">
                        <div class="category-card cursor-pointer group relative rounded-lg overflow-hidden shadow-lg" 
                             data-category-id="<?php echo e($category->id); ?>" 
                             data-category-name="<?php echo e($category->getTranslation('category_name', app()->getLocale())); ?>">
                            
                            <img src="<?php echo e(asset('storage/' . $category->image_url)); ?>" 
                                 alt="<?php echo e($category->getTranslation('category_name', app()->getLocale())); ?>" 
                                 class="w-full h-56 sm:h-80 object-cover"
                                 loading="lazy" decoding="async"
                                 onerror="this.src='https://placehold.co/500x500/102b19/E6D793?text=<?php echo e(urlencode($category->getTranslation('category_name', app()->getLocale()))); ?>'">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent"></div>
                            <h3 class="text-lg sm:text-2xl"><?php echo e($category->getTranslation('category_name', app()->getLocale())); ?></h3>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="sm:col-span-2 lg:col-span-3 text-center text-accent/60 py-16">
                        <i data-lucide="archive" class="w-16 h-16 mx-auto mb-4"></i>
                        <h3 class="text-2xl font-bold"><?php echo e(__('Kategori Belum Tersedia')); ?></h3>
                        <p><?php echo e(__('Saat ini belum ada kategori produk yang bisa ditampilkan.')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div id="product-view" class="hidden">
            <div class="text-center mb-12">
                <button id="back-to-categories" class="mb-4">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    <?php echo e(__('Kembali ke Semua Kategori')); ?>

                </button>
                <h2 id="product-view-title" class="text-4xl md:text-5xl font-serif font-bold text-accent reveal-animation"></h2>
            </div>
            <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-8"></div>
            <div id="no-results" class="text-center text-accent/60 py-16 hidden">
                <i data-lucide="frown" class="w-16 h-16 mx-auto mb-4"></i>
                <h3 class="text-2xl font-bold"><?php echo e(__('Produk tidak ditemukan')); ?></h3>
                <p><?php echo e(__('Saat ini tidak ada produk dalam kategori ini.')); ?></p>
            </div>
        </div>
    </div>
</section>


<div id="description-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm opacity-0 hidden transition-opacity duration-300">
    <div id="modal-content-wrapper" class="w-full max-w-lg bg-dark-card rounded-2xl shadow-2xl p-6 relative scale-95 transition-transform duration-300">
        
        
        
        
        
        <button id="modal-close-btn" 
                class="absolute top-3 right-3 z-10 
                       w-9 h-9 bg-white rounded-full 
                       flex items-center justify-center 
                       text-primary shadow-lg 
                       hover:bg-gray-200 transition-colors">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        
        
        
        

        <div id="modal-body">
            
        </div>
    </div>
</div>


<script>
    window.DjamoePageData = {
        translations: {
            loadingProducts: "<?php echo e(__('Memuat produk...')); ?>",
            bestSeller: "<?php echo e(__('Best Seller')); ?>",
            viewDetails: "<?php echo e(__('Lihat Detail')); ?>",
            loadProductFailed: "<?php echo e(__('Gagal memuat produk. Coba lagi.')); ?>",
            loadingDetails: "<?php echo e(__('Memuat detail...')); ?>",
            descriptionNotAvailable: "<?php echo e(__('Deskripsi tidak tersedia.')); ?>",
            orderViaWhatsApp: "<?php echo e(__('Pesan via WhatsApp')); ?>",
            loadDetailFailed: "<?php echo e(__('Gagal memuat detail produk.')); ?>",
            productNameNotAvailable: "<?php echo e(__('Nama Produk Tidak Tersedia')); ?>"
        },
        whatsappNumber: '<?php echo e($whatsappNumber ?? '6282232279783'); ?>',
        locale: '<?php echo e(app()->getLocale()); ?>'
    };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/produk.blade.php ENDPATH**/ ?>