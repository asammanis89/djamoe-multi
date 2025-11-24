

<?php $__env->startSection('content_header'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', 'Dashboard - Ringkasan Administrasi'); ?>

<?php $__env->startSection('content'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Ringkasan dan statistik sistem Anda</p>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        
        
        <div class="row mb-4">
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-box"></i>
                    </div>
                    <div style="position: relative; z-index: 1;">
                        <div class="stat-number"><?php echo e($totalProduk); ?></div>
                        <div class="stat-label">Total Produk</div>
                        <a href="<?php echo e(route('admin.products.index')); ?>" class="stat-link">
                            Kelola Produk <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div style="position: relative; z-index: 1;">
                        <div class="stat-number"><?php echo e($totalKategori); ?></div>
                        <div class="stat-label">Total Kategori</div>
                        <a href="<?php echo e(route('admin.categories.index')); ?>" class="stat-link">
                            Kelola Kategori <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div style="position: relative; z-index: 1;">
                        <div class="stat-number"><?php echo e($totalArtikel); ?></div>
                        <div class="stat-label">Total Artikel</div>
                        <a href="<?php echo e(route('admin.articles.index')); ?>" class="stat-link">
                            Lihat Artikel <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-users"></i>
                    </div>
                    <div style="position: relative; z-index: 1;">
                        <div class="stat-number"><?php echo e($totalUsers); ?></div>
                        <div class="stat-label">Total Pengguna Admin</div>
                        <a href="<?php echo e(route('admin.users.index')); ?>" class="stat-link">
                            Kelola Pengguna <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-lg-4 mb-4">
                <div class="welcome-card">
                    <h4 class="mb-3">
                        <i class="fas fa-hand-sparkles mr-2"></i>
                        Selamat Datang!
                    </h4>
                    <p class="mb-2" style="opacity: 0.95; font-size: 1.1rem;">
                        <strong><?php echo e(Auth::user()->name); ?></strong>
                    </p>
                    <p class="mb-4" style="opacity: 0.9;">
                        Role: <strong><?php echo e(strtoupper(Auth::user()->role)); ?></strong>
                    </p>
                    
                    <div class="d-flex flex-column">
                        
                        
                        
                        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-light quick-action-btn mb-3">
                            <i class="fas fa-plus-circle mr-2"></i>Tambah Produk
                        </a>
                        <a href="<?php echo e(route('admin.articles.index')); ?>" class="btn btn-outline-light quick-action-btn">
                            <i class="fas fa-pen mr-2"></i>Tulis Artikel
                        </a>
                        
                    </div>
                    
                    <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.3);">
                        <small style="opacity: 0.9;">
                            <i class="fas fa-clock mr-2"></i>
                            <?php echo e(now()->format('d M Y, H:i')); ?>

                        </small>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-4 mb-4">
                <div class="chart-card">
                    <h5 class="chart-title">
                        <i class="fas fa-chart-pie"></i>
                        Distribusi Data
                    </h5>
                    <canvas id="dataChart"></canvas>
                    <div class="mt-3">
                        <div class="legend-item">
                            <div class="legend-color" style="background: #10b981;"></div>
                            <span class="legend-label">Produk</span>
                            <span class="legend-value"><?php echo e($totalProduk); ?></span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #059669;"></div>
                            <span class="legend-label">Kategori</span>
                            <span class="legend-value"><?php echo e($totalKategori); ?></span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #34d399;"></div>
                            <span class="legend-label">Artikel</span>
                            <span class="legend-value"><?php echo e($totalArtikel); ?></span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #6ee7b7;"></div>
                            <span class="legend-label">Pengguna Admin</span>
                            <span class="legend-value"><?php echo e($totalUsers); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-4 mb-4">
                <div class="status-card p-4">
                    <h5 class="mb-4" style="color: var(--emerald); font-weight: 600;">
                        <i class="fas fa-cog mr-2" style="color: var(--primary-green);"></i>
                        Kelola Komponen
                    </h5>
                    
                    <div class="status-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-info-circle mr-2" style="color: var(--primary-green);"></i>
                                <strong>About Us</strong>
                                <small class="d-block text-muted ml-4">Kelola history</small>
                            </div>
                            <a href="<?php echo e(route('admin.abouts.index')); ?>" class="status-badge">
                                Edit <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="status-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-map-marker-alt mr-2" style="color: var(--primary-green);"></i>
                                <strong>Lokasi Outlet</strong>
                                <small class="d-block text-muted ml-4">Atur lokasi toko</small>
                            </div>
                            <a href="<?php echo e(route('admin.locations.index')); ?>" class="status-badge">
                                Edit <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="status-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-image mr-2" style="color: var(--primary-green);"></i>
                                <strong>Flyer & Banner</strong>
                                <small class="d-block text-muted ml-4">Kelola promosi</small>
                            </div>
                            <a href="<?php echo e(route('admin.flyers.index')); ?>" class="status-badge">
                                Edit <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $__env->stopSection(); ?>





<?php $__env->startSection('js'); ?>
<style>
    :root {
        --primary-green: #10b981;
        --dark-green: #059669;
        --light-green: #d1fae5;
        --success-green: #34d399;
        --emerald: #065f46;
    }
    
    .modern-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 4px 6px rgba(16, 185, 129, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        background: white;
    }
    
    .modern-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(16, 185, 129, 0.15);
    }
    
    .stat-card {
        position: relative;
        padding: 30px;
        border-radius: 20px;
        overflow: hidden;
        background: white;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        border-color: var(--primary-green);
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(16, 185, 129, 0.2);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: var(--light-green);
        border-radius: 50%;
        opacity: 0.5;
    }
    
    .stat-card .icon-wrapper {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .stat-number {
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--emerald);
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 0.95rem;
        color: #6b7280;
        font-weight: 500;
    }
    
    .stat-link {
        display: inline-flex;
        align-items: center;
        margin-top: 15px;
        padding: 10px 20px;
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        border-radius: 25px;
        color: white;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
    
    .stat-link:hover {
        transform: translateX(5px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .welcome-card {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--dark-green) 100%);
        color: white;
        border-radius: 20px;
        padding: 35px;
        border: none;
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.25);
    }
    
    .quick-action-btn {
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        border: 2px solid white;
        transition: all 0.3s ease;
        background: transparent;
    }
    
    .quick-action-btn:hover {
        background: white;
        color: var(--primary-green) !important;
        transform: translateY(-2px);
    }
    
    .chart-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(16, 185, 129, 0.1);
        border: 2px solid #e5e7eb;
    }
    
    .status-card {
        border-radius: 20px;
        border: 2px solid #e5e7eb;
        box-shadow: 0 4px 6px rgba(16, 185, 129, 0.1);
        background: white;
    }
    
    .status-item {
        padding: 18px 20px;
        border-left: 4px solid var(--primary-green);
        margin-bottom: 15px;
        background: #f9fafb;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .status-item:hover {
        background: var(--light-green);
        transform: translateX(8px);
        border-left-width: 6px;
    }
    
    .status-badge {
        padding: 8px 18px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        color: white;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }
    
    .status-badge:hover {
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        transform: scale(1.05);
        color: white;
        text-decoration: none;
    }
    
    .page-header {
        margin-bottom: 35px;
    }
    
    .page-title {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
    }
    
    .page-subtitle {
        color: #6b7280;
        font-size: 1.05rem;
    }
    
    .chart-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--emerald);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
    }
    
    .chart-title i {
        color: var(--primary-green);
        margin-right: 10px;
    }
    
    #dataChart {
        max-height: 280px;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        padding: 8px;
        border-radius: 8px;
        transition: background 0.3s ease;
    }
    
    .legend-item:hover {
        background: #f9fafb;
    }
    
    .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 4px;
        margin-right: 12px;
    }
    
    .legend-label {
        font-size: 0.9rem;
        color: #4b5563;
        font-weight: 500;
    }
    
    .legend-value {
        margin-left: auto;
        font-weight: 700;
        color: var(--emerald);
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('dataChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Produk', 'Kategori', 'Artikel', 'Pengguna Admin'],
                datasets: [{
                    data: [
                        <?php echo e($totalProduk); ?>,
                        <?php echo e($totalKategori); ?>,
                        <?php echo e($totalArtikel); ?>,
                        <?php echo e($totalUsers); ?>

                    ],
                    backgroundColor: [
                        '#10b981',
                        '#059669',
                        '#34d399',
                        '#6ee7b7'
                    ],
                    borderWidth: 0,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#065f46',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        borderColor: '#10b981',
                        borderWidth: 2,
                        cornerRadius: 8
                    }
                },
                cutout: '65%',
                
                // ===================================
                // ===== PERUBAHAN DILAKUKAN DI SINI =====
                // ===================================
                animation: false 
                // ===================================

            }
        });
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER-5\PROYEK TEKNOLOGI INFORMASI\PERTEMUAN 6\djamoe-web-multibahasa\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>