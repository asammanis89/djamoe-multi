@extends('adminlte::page')

{{-- Bagian ini akan mengisi judul halaman di tab browser --}}
@section('title', 'Admin Panel | Djamoe')

{{-- Bagian ini akan mengisi judul di bagian atas konten halaman --}}
@section('content_header')
    <h1 class="m-0 text-dark">@yield('content_header_title', 'Dashboard')</h1>
@stop

{{-- Ini adalah bagian utama konten halaman, di mana tabel dan form akan muncul --}}
@section('content')
    @yield('main-content')
@stop

{{-- Bagian ini untuk menambahkan file CSS kustom --}}
@section('css')
    {{-- 
      ==================================================
      CSS OVERRIDE UNTUK TEMA HIJAU KUSTOM
      ==================================================
      Ini akan menimpa warna 'navbar-success' dan 'sidebar-dark-success'
      default dengan warna hijau kustom Anda.
    --}}
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
    
    {{-- Ini akan mengambil CSS dari halaman anak (jika ada) --}}
    @stack('css_page')
@stop

{{-- Bagian ini untuk menambahkan file JavaScript kustom --}}
@section('js')
    <script>
        // Inisialisasi plugin untuk menampilkan nama file pada input file bootstrap
        // Ini akan berjalan di SEMUA halaman sekarang
        $(document).ready(function () {
          bsCustomFileInput.init();
        });
    </script>
    
    {{-- Ini akan mengambil JS dari halaman anak (Produk, User, dll) --}}
    @stack('js_page')
@stop