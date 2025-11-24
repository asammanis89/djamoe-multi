


<?php $__env->startSection('title', 'Admin Panel | Djamoe'); ?>


<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo $__env->yieldContent('content_header_title', 'Dashboard'); ?></h1>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('main-content'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('css'); ?>
    
    <style>
        :root {
            --primary-green: #10b981;
            --dark-green: #059669;
            --dark-sidebar: #1f2937; /* Warna hitam/gelap untuk sidebar */
            --dark-sidebar-border: #374151; /* Warna border pemisah di sidebar */
        }

        /* 1. Mengganti warna Navbar (Top) */
        .navbar-success {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--dark-green) 100%) !important;
            border-bottom: none !important;
        }

        /* 2. Mengganti warna Sidebar (Kiri) */
        .sidebar-dark-success {
            background-color: var(--dark-sidebar) !important;
        }

        /* 3. Mengganti warna Brand/Logo di Sidebar */
        .sidebar-dark-success .brand-link {
            background-color: var(--dark-sidebar) !important;
            border-bottom: 1px solid var(--dark-sidebar-border) !important;
        }

        /* 4. Mengganti warna link menu yang AKTIF */
        .sidebar-dark-success .nav-sidebar > .nav-item > .nav-link.active {
            background-color: var(--primary-green) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            border-radius: 8px;
        }

        /* 5. Mengganti warna link menu saat di-hover */
        .sidebar-dark-success .nav-sidebar > .nav-item > .nav-link:hover:not(.active) {
            background-color: rgba(16, 185, 129, 0.1) !important;
            color: var(--primary-green) !important;
        }

        /* 6. Mengganti warna panah dropdown yang aktif */
        .sidebar-dark-success .nav-item.menu-is-opening.menu-open > .nav-link {
             background-color: rgba(16, 185, 129, 0.1) !important;
             color: var(--primary-green) !important;
        }
    </style>
    
    
    <?php echo $__env->yieldPushContent('css_page'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script>
        // Inisialisasi plugin untuk menampilkan nama file pada input file bootstrap
        // Ini akan berjalan di SEMUA halaman sekarang
        $(document).ready(function () {
          bsCustomFileInput.init();
        });
    </script>
    
    
    <?php echo $__env->yieldPushContent('js_page'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>