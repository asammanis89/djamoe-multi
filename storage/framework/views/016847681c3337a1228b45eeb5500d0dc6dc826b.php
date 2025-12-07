
<?php $__env->startSection('title', __('Produk') . ' - D\'jamoe'); ?>

<?php $__env->startPush('styles'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/pages/produk.css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="relative pt-20 pb-8 md:pt-32 md:pb-12 bg-elegant overflow-hidden">
    
    <div class="absolute -left-20 top-20 w-96 h-96 bg-[#E6D793] rounded-full blur-[120px] opacity-10 pointer-events-none animate-pulse-slow"></div>
    <div class="absolute -right-20 bottom-20 w-96 h-96 bg-[#E6D793] rounded-full blur-[120px] opacity-10 pointer-events-none animate-pulse-slow" style="animation-delay: 2s;"></div>
    
    <div class="container mx-auto px-4 text-center relative z-10">
        <span class="inline-block px-6 py-2 bg-[#E6D793]/20 text-[#E6D793] rounded-full text-xs font-bold uppercase tracking-widest mb-6 border border-[#E6D793]/30 reveal-animation">
            <?php echo e(__('Katalog D\'jamoe')); ?>

        </span>

        <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#E6D793] mb-6 reveal-animation leading-tight" style="text-shadow: 0 4px 20px rgba(0,0,0,0.8);">
            <?php echo e(__('Pilihan Produk Terbaik')); ?>

        </h1>
        <p class="text-[#FBF8ED]/80 text-base md:text-xl max-w-3xl mx-auto leading-relaxed reveal-animation" style="transition-delay: 100ms;">
            <?php echo e(__('Temukan jamu tradisional berkualitas premium dengan rasa autentik dan khasiat terjamin untuk kesehatan Anda.')); ?>

        </p>
    </div>
</section>


<section id="produk" class="pt-8 pb-16 md:pt-12 md:pb-24 bg-mint relative overflow-hidden">
    
    

    <div class="container mx-auto px-4 relative z-10">

        
        
        
        <div id="category-view">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-5xl font-serif font-bold text-[#1A3A24] reveal-animation">
                    <?php echo e(__('Kategori Pilihan')); ?>

                </h2>
                <div class="w-20 h-1.5 bg-gradient-to-r from-transparent via-[#E6D793] to-transparent mx-auto mt-6 rounded-full reveal-animation"></div>
                <p class="text-[#1A3A24]/70 mt-6 max-w-2xl mx-auto text-sm md:text-base reveal-animation" style="transition-delay: 100ms;">
                    <?php echo e(__('Pilih kategori jamu sesuai dengan kebutuhan kesehatan tubuh Anda.')); ?>

                </p>
            </div>

            <div id="category-grid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="category-card-wrapper reveal-animation" style="transition-delay: <?php echo e($index * 50); ?>ms;">
                        
                        <div class="category-card cursor-pointer group relative rounded-2xl overflow-hidden shadow-soft hover:shadow-2xl transition-all duration-500 bg-white" 
                             data-category-id="<?php echo e($category->id); ?>" 
                             data-category-name="<?php echo e($category->getTranslation('category_name', app()->getLocale())); ?>">

                            <div class="relative h-56 sm:h-80 overflow-hidden">
                                <img src="<?php echo e(asset('storage/' . $category->image_url)); ?>" 
                                     alt="<?php echo e($category->getTranslation('category_name', app()->getLocale())); ?>" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 group-hover:rotate-2"
                                     loading="lazy" 
                                     onerror="this.src='https://placehold.co/500x500/102b19/E6D793?text=<?php echo e(urlencode($category->getTranslation('category_name', app()->getLocale()))); ?>'">

                                <div class="absolute inset-0 bg-gradient-to-t from-[#1A3A24]/90 via-[#1A3A24]/40 to-transparent transition-all duration-500"></div>

                                <div class="absolute top-4 right-4 w-10 h-10 bg-[#E6D793] rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110 shadow-lg">
                                    <i data-lucide="arrow-right" class="w-5 h-5 text-[#1A3A24]"></i>
                                </div>
                            </div>

                            <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-xl sm:text-2xl font-serif font-bold text-[#E6D793] text-center drop-shadow-md">
                                    <?php echo e($category->getTranslation('category_name', app()->getLocale())); ?>

                                </h3>
                                <p class="text-[#FBF8ED]/90 text-xs sm:text-sm text-center mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 tracking-wider uppercase">
                                    <?php echo e(__('Lihat Produk')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full text-center py-16">
                        <p class="text-[#1A3A24]/60"><?php echo e(__('Kategori belum tersedia.')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        
        
        <div id="product-view" class="hidden">
            <div class="text-center mb-12">
                <button id="back-to-categories" class="inline-flex items-center gap-2 bg-[#1A3A24] text-[#E6D793] py-3 px-6 rounded-full font-bold text-sm uppercase tracking-wider transition-all duration-300 hover:bg-[#0F2318] hover:shadow-lg hover:-translate-y-1 mb-8 shadow-md border border-[#E6D793]/30">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <?php echo e(__('Kembali ke Kategori')); ?>

                </button>

                <h2 id="product-view-title" class="text-3xl md:text-5xl font-serif font-bold text-[#1A3A24] reveal-animation"></h2>
                <div class="w-16 h-1.5 bg-[#E6D793] mx-auto mt-4 rounded-full"></div>
            </div>

            
            <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-8 pb-12"></div>

            <div id="no-results" class="text-center py-16 hidden">
                <div class="bg-white rounded-2xl shadow-soft p-12 max-w-md mx-auto border border-[#E6D793]/20">
                    <i data-lucide="leaf" class="w-16 h-16 mx-auto mb-4 text-[#1A3A24]/20"></i>
                    <h3 class="text-xl font-serif font-bold text-[#1A3A24] mb-2"><?php echo e(__('Produk Kosong')); ?></h3>
                    <p class="text-[#1A3A24]/60"><?php echo e(__('Belum ada produk dalam kategori ini.')); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>




<div id="description-modal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm opacity-0 hidden transition-opacity duration-300">
    
    
    <div id="modal-content-wrapper" class="w-full max-w-2xl bg-batik-modal rounded-3xl shadow-2xl overflow-hidden scale-95 transition-transform duration-300 max-h-[90vh] overflow-y-auto relative border border-[#E6D793]/40">
        
        
        <button id="modal-close-btn" 
                class="absolute top-4 right-4 z-[10000]
                       w-10 h-10 bg-[#1A3A24]/90 backdrop-blur-md rounded-full 
                       flex items-center justify-center 
                       text-[#E6D793] shadow-lg border-2 border-white/10
                       hover:bg-[#E6D793] hover:text-[#1A3A24] transition-all duration-300
                       hover:scale-110 active:scale-95">
            <i data-lucide="x" class="w-5 h-5 font-bold"></i>
        </button>

        
        <div id="modal-body" class="relative">
            
            <div class="flex justify-center items-center h-64">
                <div class="loading-spinner w-10 h-10"></div>
            </div>
        </div>
    </div>
</div>

<script>
    window.DjamoePageData = {
        translations: {
            loadingProducts: "<?php echo e(__('Memuat produk...')); ?>",
            bestSeller: "<?php echo e(__('Best Seller')); ?>",
            viewDetails: "<?php echo e(__('Lihat Detail')); ?>",
            loadProductFailed: "<?php echo e(__('Gagal memuat produk.')); ?>",
            loadingDetails: "<?php echo e(__('Memuat detail...')); ?>",
            descriptionNotAvailable: "<?php echo e(__('Deskripsi tidak tersedia.')); ?>",
            orderViaWhatsApp: "<?php echo e(__('Pesan via WhatsApp')); ?>",
            loadDetailFailed: "<?php echo e(__('Gagal memuat detail.')); ?>",
            productNameNotAvailable: "<?php echo e(__('Nama Produk')); ?>"
        },
        whatsappNumber: '<?php echo e($whatsappNumber ?? '6282232279783'); ?>',
        locale: '<?php echo e(app()->getLocale()); ?>'
    };

    // ===============================================
    // SCRIPT KLIK CARD DIMANA SAJA (EVENT DELEGATION)
    // ===============================================
    document.addEventListener('DOMContentLoaded', function() {
        const productGrid = document.getElementById('product-grid');

        if (productGrid) {
            productGrid.addEventListener('click', function(e) {
                // 1. Cek apakah yang diklik adalah bagian dari product-card
                const card = e.target.closest('.product-card');
                
                // 2. Jika ya, cari tombol detail di dalamnya
                if (card) {
                    const detailBtn = card.querySelector('.detail-btn');
                    
                    // 3. Jika tombol ketemu DAN yang diklik bukan tombol itu sendiri (biar ga double trigger)
                    if (detailBtn && e.target !== detailBtn && !detailBtn.contains(e.target)) {
                        // Trigger klik manual pada tombol detail
                        detailBtn.click();
                    }
                }
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/pages/produk-ajax.js'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/produk.blade.php ENDPATH**/ ?>