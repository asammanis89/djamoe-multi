@extends('layouts.app')
@section('title', __('Tentang Kami') . " - D'jamoe")
@section('content')

{{-- HERO SECTION --}}
<section class="relative h-[60vh] bg-cover bg-center flex items-center justify-center text-center text-white"
    style="background-image: linear-gradient(rgba(10, 28, 17, 0.7), rgba(10, 28, 17, 0.8)), url('{{ asset('gambar/gambar22.jpeg') }}');">
    <div class="reveal-animation">
        <h1 class="text-4xl md:text-7xl font-serif font-bold text-accent">{{ __('Kisah Kami') }}</h1>
        {{-- REVISI: Font mobile disesuaikan --}}
        <p class="mt-4 text-base md:text-xl max-w-3xl mx-auto text-white/90">{{ __('Dari Dapur Sederhana, Menjadi Warisan Kebaikan untuk Indonesia.') }}</p>
    </div>
</section>

{{-- STORY SECTION --}}
{{-- REVISI: Padding (py) & spasi (space-y) mobile dikurangi --}}
<section class="py-12 md:py-24">
    <div class="container mx-auto px-4 space-y-12 md:space-y-24">
        @forelse ($abouts as $item)
        <div class="flex flex-col {{ $loop->even ? 'md:flex-row-reverse' : 'md:flex-row' }} items-center gap-8 md:gap-16 reveal-animation">
            <div class="md:w-1/2">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-auto object-cover aspect-video rounded-2xl" loading="lazy" decoding="async">
            </div>
            <div class="md:w-1/2 text-center {{ $loop->even ? 'md:text-right' : 'md:text-left' }}">
                <p class="font-semibold text-accent/80 tracking-widest uppercase">{{ $item->year_text }}</p>
                {{-- REVISI: Font h3 mobile disesuaikan --}}
                <h3 class="text-3xl md:text-5xl font-serif font-bold mt-2 text-accent">{{ $item->title }}</h3>
                <div class="w-24 h-px bg-accent/30 my-6 mx-auto {{ $loop->even ? 'md:ml-auto md:mr-0' : 'md:mx-0' }}"></div>
                {{-- REVISI: Font p mobile disesuaikan --}}
                <p class="text-base md:text-lg text-light-text/80 leading-relaxed normal-case">{{ $item->description }}</p>
            </div>
        </div>
        @empty
        <div class="text-center text-accent/70 py-12"><p>{{ __('Belum ada cerita yang ditambahkan.') }}</p></div>
        @endforelse
    </div>
</section>

{{-- "KEKUATAN DARI ALAM" SECTION --}}
{{-- REVISI: Padding (py) mobile dikurangi --}}
<section class="py-12 md:py-20 bg-dark-card">
    <div class="container mx-auto px-4 text-center">
        {{-- REVISI: Font h2 & margin (mb) mobile disesuaikan --}}
        <h2 class="text-3xl md:text-5xl font-serif font-bold text-accent reveal-animation">{{ __('Kekuatan dari Alam') }}</h2>
        <p class="mt-2 mb-8 md:mb-12 text-base md:text-lg text-accent/70 max-w-2xl mx-auto reveal-animation" style="transition-delay: 100ms;">{{ __('Setiap tegukan D\'jamoe mengandung kebaikan dari rempah-rempah pilihan Indonesia.') }}</p>
        
        {{-- =============================================== --}}
        {{-- === PERBAIKAN: GRID MOBILE JADI 2 KOLOM (grid-cols-2) === --}}
        {{-- (Jarak 'gap' juga disesuaikan untuk mobile) --}}
        {{-- =============================================== --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
            <div class="card-container reveal-animation" style="transition-delay: 200ms;">
                {{-- REVISI: Padding mobile (p-4) disesuaikan --}}
                <div class="spice-card bg-dark-bg p-4 md:p-8 rounded-2xl shadow-lg h-full">
                    <i data-lucide="leaf" class="w-10 h-10 md:w-12 md:h-12 mx-auto text-accent"></i>
                    {{-- REVISI: Font h3 & p mobile disesuaikan --}}
                    <h3 class="mt-4 text-lg md:text-2xl font-serif font-bold">{{ __('Kunyit') }}</h3>
                    <p class="mt-2 text-sm md:text-base text-light-text/70">{{ __('Anti-inflamasi alami yang kuat...') }}</p>
                </div>
            </div>
            <div class="card-container reveal-animation" style="transition-delay: 300ms;">
                <div class="spice-card bg-dark-bg p-4 md:p-8 rounded-2xl shadow-lg h-full">
                    <i data-lucide="sun" class="w-10 h-10 md:w-12 md:h-12 mx-auto text-accent"></i>
                    <h3 class="mt-4 text-lg md:text-2xl font-serif font-bold">{{ __('Jahe') }}</h3>
                    <p class="mt-2 text-sm md:text-base text-light-text/70">{{ __('Menghangatkan tubuh, meningkatkan imunitas...') }}</p>
                </div>
            </div>
            <div class="card-container reveal-animation" style="transition-delay: 400ms;">
                <div class="spice-card bg-dark-bg p-4 md:p-8 rounded-2xl shadow-lg h-full">
                    <i data-lucide="flower-2" class="w-10 h-10 md:w-12 md:h-12 mx-auto text-accent"></i>
                    <h3 class="mt-4 text-lg md:text-2xl font-serif font-bold">{{ __('Kencur') }}</h3>
                    <p class="mt-2 text-sm md:text-base text-light-text/70">{{ __('Membantu meredakan batuk dan pegal linu...') }}</p>
                </div>
            </div>
            <div class="card-container reveal-animation" style="transition-delay: 500ms;">
                <div class="spice-card bg-dark-bg p-4 md:p-8 rounded-2xl shadow-lg h-full">
                    <i data-lucide="shield" class="w-10 h-10 md:w-12 md:h-12 mx-auto text-accent"></i>
                    <h3 class="mt-4 text-lg md:text-2xl font-serif font-bold">{{ __('Temulawak') }}</h3>
                    <p class="mt-2 text-sm md:text-base text-light-text/70">{{ __('Menjaga kesehatan hati, bertindak sebagai antioksidan...') }}</p>
                </div>
            </div>
        </div>
        {{-- =============================================== --}}
        {{-- === AKHIR PERBAIKAN GRID === --}}
        {{-- =============================================== --}}
    </div>
</section>

{{-- CALL TO ACTION (CTA) SECTION --}}
{{-- REVISI: Padding (py), font (h2, p), & ukuran tombol mobile disesuaikan --}}
<section class="py-12 md:py-20 text-center">
    <div class="container mx-auto px-4">
        <div class="reveal-animation">
            <h2 class="text-2xl md:text-4xl font-serif font-bold text-accent">{{ __('Jelajahi Kebaikan di Setiap Botolnya') }}</h2>
            <p class="mt-4 text-base md:text-lg text-light-text/70 max-w-2xl mx-auto">{{ __('Temukan varian jamu yang diciptakan khusus untuk menemani hari...') }}</p>
            <a href="{{ route('produk.index') }}" 
               class="mt-8 inline-block bg-accent text-primary font-bold py-2 px-6 md:py-3 md:px-8 text-sm md:text-base rounded-full hover:bg-opacity-90 transition-transform hover:scale-105">
               {{ __('Lihat Semua Produk') }}
            </a>
        </div>
    </div>
</section>
@endsection