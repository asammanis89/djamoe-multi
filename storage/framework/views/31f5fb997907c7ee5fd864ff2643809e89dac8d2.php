<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', "D'jamoe - Warisan Rasa Tradisional Khas Madiun"); ?></title>

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <link rel="icon" type="image/png" href="<?php echo e(asset('gambar/favicon.png')); ?>">

    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-dark-bg text-light-text min-h-screen flex flex-col overflow-x-hidden">

    <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="flex-grow overflow-y-auto">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   
<a href="https://wa.me/6282232279783?text=<?php echo e(urlencode('Halo, saya tertarik dengan produk Djamoe.')); ?>"
   target="_blank"
   class="wa-bubble fixed bottom-6 right-6 z-50 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg transition-transform hover:scale-110">
    <img src="https://img.icons8.com/?size=100&id=BkugfgmBwtEI&format=png&color=000000" 
         alt="WhatsApp Logo" 
         class="w-8 h-8" />
</a>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/layouts/app.blade.php ENDPATH**/ ?>