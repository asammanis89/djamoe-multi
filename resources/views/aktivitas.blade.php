@extends('layouts.app')
@section('title', __('Aktivitas & Wawasan') . " - D'jamoe")
@section('content')

{{-- HERO SECTION --}}
<section class="relative h-[60vh] bg-cover bg-center flex items-center justify-center text-center text-white" style="background-image: linear-gradient(rgba(10, 28, 17, 0.7), rgba(10, 28, 17, 0.8)), url('{{ asset('gambar/gambar22.jpeg') }}');">
    <div class="reveal-animation">
        <h1 class="text-4xl md:text-7xl font-serif font-bold text-accent">{{ __('Aktivitas & Wawasan') }}</h1>
        <p class="mt-4 text-base md:text-xl max-w-3xl mx-auto text-white/90">{{ __('Lebih dari sekadar produk, kami berbagi pengalaman...') }}</p>
    </div>
</section>

{{-- WAWASAN SECTION --}}
<section class="py-12 md:py-24">
    <div class="container mx-auto px-4 space-y-12 md:space-y-20">
        <div>
            <div class="bg-dark-card rounded-2xl shadow-xl p-6 md:p-12 reveal-animation">
                <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">
                    <div>
                        <img src="{{ asset('gambar/gambar22.jpeg') }}" alt="Wawasan tentang Jamu" class="rounded-lg shadow-lg mb-6 w-full object-cover aspect-video" loading="lazy">
                        <h3 class="text-2xl md:text-3xl font-serif font-bold text-accent">{{ __('Selami Lebih Dalam Dunia Jamu') }}</h3>
                        <p class="mt-4 text-sm md:text-base text-light-text/80 leading-relaxed">{{ __('Kami percaya edukasi adalah kunci...') }}</p>    
                    </div>
                    <div class="space-y-8">
                        <div>
                            <h4 class="text-xl md:text-2xl font-serif font-semibold text-accent/90 border-b-2 border-accent/20 pb-2 mb-4">{{ __('Artikel Pilihan') }}</h4>
                            <ul class="space-y-3">
                                <li><a href="#" class="flex items-center gap-3 text-sm md:text-base text-light-text/80 hover:text-accent transition-colors group"><i data-lucide="book-open" class="w-5 h-5 text-accent/70 group-hover:text-accent"></i>{{ __('Manfaat Kunyit...') }}</a></li>
                                <li><a href="#" class="flex items-center gap-3 text-sm md:text-base text-light-text/80 hover:text-accent transition-colors group"><i data-lucide="book-open" class="w-5 h-5 text-accent/70 group-hover:text-accent"></i>{{ __('Sejarah Jamu Gendong...') }}</a></li>
                                <li><a href="#" class="flex items-center gap-3 text-sm md:text-base text-light-text/80 hover:text-accent transition-colors group"><i data-lucide="book-open" class="w-5 h-5 text-accent/70 group-hover:text-accent"></i>{{ __('5 Rempah Dapur...') }}</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-xl md:text-2xl font-serif font-semibold text-accent/90 border-b-2 border-accent/20 pb-2 mb-4">{{ __('Tonton Kami di YouTube') }}</h4>
                            <ul class="space-y-3">
                                <li><a href="#" class="flex items-center gap-3 text-sm md:text-base text-light-text/80 hover:text-accent transition-colors group"><i data-lucide="youtube" class="w-5 h-5 text-accent/70 group-hover:text-accent"></i>{{ __('Proses Pembuatan...') }}</a></li>
                                <li><a href="#" class="flex items-center gap-3 text-sm md:text-base text-light-text/80 hover:text-accent transition-colors group"><i data-lucide="youtube" class="w-5 h-5 text-accent/70 group-hover:text-accent"></i>{{ __('Wawancara dengan Petani...') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PENGALAMAN UNIK SECTION --}}
        <div>
            <div class="text-center mb-8 md:mb-16">
                <h2 class="text-3xl md:text-5xl font-serif font-bold text-accent reveal-animation">{{ __('Pilihan Pengalaman Unik') }}</h2>
                <p class="mt-4 text-base md:text-lg text-light-text/70 max-w-3xl mx-auto reveal-animation" style="transition-delay: 100ms;">{{ __('Selami dunia jamu lebih dalam...') }}</p>
            </div>
            
            <div class="grid grid-cols-2 gap-4 md:gap-8 lg:grid-cols-4">
                @forelse ($articles as $article)
                <div 
                    data-title="{{ $article->title }}" 
                    data-image="{{ asset('storage/' . $article->image) }}" 
                    data-description="{{ $article->description }}" 
                    class="activity-card group cursor-pointer bg-dark-card rounded-xl md:rounded-2xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2 reveal-animation" 
                    style="transition-delay: {{ $loop->iteration * 100 }}ms;">
                    
                    <div class="relative h-36 md:h-48 overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $article->image) }}')">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end justify-center p-3 md:p-4">
                            <h2 class="text-base md:text-2xl font-serif font-bold text-white text-center line-clamp-2">{{ $article->subtitle }}</h2>
                        </div>
                    </div>
                    
                    <div class="p-4 md:p-6 flex flex-col flex-grow">
                        <h3 class="font-serif text-sm md:text-xl font-bold text-accent line-clamp-2">{{ $article->title }}</h3>
                        <div class="h-20 overflow-hidden">
                            <p class="text-light-text/70 mt-2 text-sm leading-relaxed break-words">{{ Str::limit($article->description, 100) }}</p>
                        </div>
                        <div class="mt-auto pt-3 md:pt-4">
                            <span class="font-semibold text-accent/90 group-hover:text-accent transition-colors text-xs md:text-sm">{{ __('Lihat Detail') }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <p class="col-span-full text-center text-light-text/70">{{ __('Belum ada aktivitas yang ditambahkan.') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- HTML Modal (Statis) --}}
<div id="activity-modal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[100] flex items-center justify-center p-4 hidden opacity-0">
    <div class="modal-content bg-dark-card w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-2xl shadow-2xl relative scale-95 opacity-0">
        
        {{-- =============================================== --}}
        {{-- === INI ADALAH PERBAIKAN KONSISTENSI === --}}
        {{-- (Kelas CSS disamakan dengan modal di halaman Produk) --}}
        {{-- =============================================== --}}
        <button class="close-modal absolute top-3 right-3 z-10 
                       w-9 h-9 bg-white rounded-full 
                       flex items-center justify-center 
                       text-primary shadow-lg 
                       hover:bg-gray-200 transition-colors">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        {{-- =============================================== --}}
        {{-- === AKHIR PERBAIKAN === --}}
        {{-- =============================================== --}}

        <img id="modal-image" src="" alt="Gambar Aktivitas" class="w-full h-64 object-cover rounded-t-2xl">
        <div class="p-6 md:p-8">
            <h2 id="modal-title" class="text-2xl md:text-3xl font-serif font-bold text-accent mb-4"></h2>
            <p id="modal-description" class="text-base text-light-text/80 leading-relaxed break-words"></p>
        </div>
    </div>
</div>
@endsection