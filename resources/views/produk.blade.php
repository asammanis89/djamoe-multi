@extends('layouts.app')
@section('title', __('Produk') . ' - D\'jamoe')
@section('content')
<section id="produk" class="py-24">
    <div class="container mx-auto px-4">
        {{-- Tampilan Kategori --}}
        <div id="category-view">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-accent reveal-animation">{{ __('Katalog Produk') }}</h2>
                <p class="text-light-text/70 mt-4 max-w-2xl mx-auto reveal-animation" style="transition-delay: 100ms;">
                    {{ __('Pilih kategori untuk menemukan produk yang paling sesuai.') }}
                </p>
            </div>
            <div id="category-grid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-8">
                @forelse ($categories as $index => $category)
                    <div class="category-card-container reveal-animation" style="transition-delay: {{ $index * 50 }}ms;">
                        <div class="category-card cursor-pointer group relative rounded-lg overflow-hidden shadow-lg" 
                             data-category-id="{{ $category->id }}" 
                             data-category-name="{{ $category->getTranslation('category_name', app()->getLocale()) }}">
                            
                            <img src="{{ asset('storage/' . $category->image_url) }}" 
                                 alt="{{ $category->getTranslation('category_name', app()->getLocale()) }}" 
                                 class="w-full h-56 sm:h-80 object-cover"
                                 loading="lazy" decoding="async"
                                 onerror="this.src='https://placehold.co/500x500/102b19/E6D793?text={{ urlencode($category->getTranslation('category_name', app()->getLocale())) }}'">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent"></div>
                            <h3 class="text-lg sm:text-2xl">{{ $category->getTranslation('category_name', app()->getLocale()) }}</h3>
                        </div>
                    </div>
                @empty
                    <div class="sm:col-span-2 lg:col-span-3 text-center text-accent/60 py-16">
                        <i data-lucide="archive" class="w-16 h-16 mx-auto mb-4"></i>
                        <h3 class="text-2xl font-bold">{{ __('Kategori Belum Tersedia') }}</h3>
                        <p>{{ __('Saat ini belum ada kategori produk yang bisa ditampilkan.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Tampilan Produk (Awalnya Tersembunyi) --}}
        <div id="product-view" class="hidden">
            <div class="text-center mb-12">
                <button id="back-to-categories" class="mb-4">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    {{ __('Kembali ke Semua Kategori') }}
                </button>
                <h2 id="product-view-title" class="text-4xl md:text-5xl font-serif font-bold text-accent reveal-animation"></h2>
            </div>
            <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-8"></div>
            <div id="no-results" class="text-center text-accent/60 py-16 hidden">
                <i data-lucide="frown" class="w-16 h-16 mx-auto mb-4"></i>
                <h3 class="text-2xl font-bold">{{ __('Produk tidak ditemukan') }}</h3>
                <p>{{ __('Saat ini tidak ada produk dalam kategori ini.') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- HTML Modal (dipindahkan dari app.blade.php) --}}
<div id="description-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm opacity-0 hidden transition-opacity duration-300">
    <div id="modal-content-wrapper" class="w-full max-w-lg bg-dark-card rounded-2xl shadow-2xl p-6 relative scale-95 transition-transform duration-300">
        
        {{-- =============================================== --}}
        {{-- === INI ADALAH PERBAIKANNYA === --}}
        {{-- =============================================== --}}
        
        <button id="modal-close-btn" 
                class="absolute top-3 right-3 z-10 
                       w-9 h-9 bg-white rounded-full 
                       flex items-center justify-center 
                       text-primary shadow-lg 
                       hover:bg-gray-200 transition-colors">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        
        {{-- =============================================== --}}
        {{-- === AKHIR PERBAIKAN === --}}
        {{-- =============================================== --}}

        <div id="modal-body">
            {{-- Konten diisi oleh JavaScript --}}
        </div>
    </div>
</div>

{{-- Data passing dari Laravel ke JS --}}
<script>
    window.DjamoePageData = {
        translations: {
            loadingProducts: "{{ __('Memuat produk...') }}",
            bestSeller: "{{ __('Best Seller') }}",
            viewDetails: "{{ __('Lihat Detail') }}",
            loadProductFailed: "{{ __('Gagal memuat produk. Coba lagi.') }}",
            loadingDetails: "{{ __('Memuat detail...') }}",
            descriptionNotAvailable: "{{ __('Deskripsi tidak tersedia.') }}",
            orderViaWhatsApp: "{{ __('Pesan via WhatsApp') }}",
            loadDetailFailed: "{{ __('Gagal memuat detail produk.') }}",
            productNameNotAvailable: "{{ __('Nama Produk Tidak Tersedia') }}"
        },
        whatsappNumber: '{{ $whatsappNumber ?? '6282232279783' }}',
        locale: '{{ app()->getLocale() }}'
    };
</script>
@endsection