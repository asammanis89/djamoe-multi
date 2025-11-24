<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    */

    'title' => "D'jamoe Admin",
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    */

    'google_fonts' => [
        'allowed' => true,
    ],

   /*
|--------------------------------------------------------------------------
| Admin Panel Logo
|--------------------------------------------------------------------------
*/

'logo' => "<b style='margin-left: 1.1rem;'>D'jamoe Admin</b>",
'logo_img' => null,           // ✅ Hanya satu logo
'logo_img_class' => null,
'logo_img_xl' => null,                        // ⛔ Kosongkan
'logo_img_xl_class' => null,
'logo_img_alt' => null,
/*
|--------------------------------------------------------------------------
| Authentication Logo
|--------------------------------------------------------------------------
*/

'auth_logo' => [
    'enabled' => false, // Aktifkan jika ingin logo di halaman login
    'img' => [
        'path' => 'gambar/logo_dj.png', // ✅ Path relatif
        'alt' => 'Logo D\'jamoe',
        'class' => 'img-fluid',
        'width' => 80,
        'height' => null,
    ],
],

/*
|--------------------------------------------------------------------------
| Preloader Animation
|--------------------------------------------------------------------------
*/

'preloader' => [
    'enabled' => false,
    'mode' => 'fullscreen',
    'img' => [
        'path' => 'gambar/logo_dj.png', // ✅ Tambahkan ini!
        'alt' => 'Logo D\'jamoe',
        'effect' => 'animation__shake',
        'width' => 60,
        'height' => 60,
    ],
],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true, // PERBAIKAN: Aktifkan sidebar tetap
    'layout_fixed_navbar' => true, // PERBAIKAN: Aktifkan navbar tetap
    'layout_fixed_footer' => null,
    'layout_dark_mode' => false, // PERBAIKAN: Aktifkan dark mode

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-success elevation-4', // PERBAIKAN: Ubah warna sidebar menjadi hijau
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-dark navbar-success', // PERBAIKAN: Ubah warna navbar menjadi hijau
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => false,
    'right_sidebar_push' => false,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    */

    'use_route_url' => true,
    'dashboard_url' => 'admin.dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    */

// config/adminlte.php
'menu' => [

     [
        'text' => 'Beranda',
        'route' => 'admin.dashboard',
        'icon' => 'fas fa-fw fa-cog',
     ],
    // 📰 MANAJEMEN KONTEN (Dropdown)
    [
        'text' => 'Manajemen Konten',
        'icon' => 'fas fa-fw fa-pen-nib',
        'submenu' => [
            [
                'text' => 'Slider Beranda',
                'route'  => 'admin.flyers.index',
                'icon' => 'far fa-fw fa-images',
            ],
            [
                'text' => 'Aktivitas',
                'route'  => 'admin.articles.index',
                'icon' => 'fas fa-fw fa-newspaper',
            ],
            [
                'text' => 'Temukan Kami',
                'route'  => 'admin.locations.index',
                'icon' => 'fas fa-fw fa-map-marked-alt',
            ],
            [
                'text' => 'Tentang Kami',
                'route'  => 'admin.abouts.index',
                'icon' => 'fas fa-fw fa-info-circle',
            ],
        ],
    ],

    // 📦 MANAJEMEN PRODUK (Dropdown)
    [
        'text' => 'Manajemen Produk',
        'icon' => 'fas fa-fw fa-boxes',
        'submenu' => [
            [
                'text' => 'Produk',
                'route'  => 'admin.products.index',
                'icon' => 'fas fa-fw fa-box',
            ],
            [
                'text' => 'Kategori',
                'route'  => 'admin.categories.index',
                'icon' => 'fas fa-fw fa-tags',
            ],
        ],
    ],

    // 👥 MANAJEMEN ADMIN (Hanya Superadmin)
    [
        'text' => 'Manajemen Admin',
        'icon' => 'fas fa-fw fa-users-cog',
        'can' => 'superadmin',
        'submenu' => [
            [
                'text' => 'Daftar Admin',
                'route' => 'admin.users.index',
                'icon' => 'fas fa-fw fa-list',
            ],
        ],
    ],
    
],
    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true, // PERBAIKAN: Aktifkan notifikasi modern
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11', // PERBAIKAN: Versi lebih baru
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    */

    'livewire' => false,
];

