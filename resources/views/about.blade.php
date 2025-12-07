@extends('layouts.app')
@section('title', __('Tentang Kami') . " - D'jamoe")

@push('styles')
    {{-- Menggunakan CSS yang sama dengan Aktivitas/Outlet agar konsisten --}}
    @vite(['resources/css/pages/about.css', 'resources/css/pages/aktivitas.css'])
@endpush

@section('content')

{{-- 1. HERO SECTION --}}
{{-- KONSISTENSI: Menggunakan struktur Hero yang sama dengan Aktivitas & Outlet --}}
<section class="relative pt-20 pb-8 md:pt-32 md:pb-12 bg-elegant-activity overflow-hidden">
    {{-- Dekorasi Background --}}
    <div class="absolute -left-20 top-20 w-96 h-96 bg-[#E6D793] rounded-full blur-[120px] opacity-10 pointer-events-none animate-pulse-slow"></div>
    <div class="absolute -right-20 bottom-20 w-96 h-96 bg-[#E6D793] rounded-full blur-[120px] opacity-10 pointer-events-none animate-pulse-slow" style="animation-delay: 2s;"></div>

    <div class="container mx-auto px-4 text-center relative z-10">
        <span class="inline-block px-6 py-2 bg-[#E6D793]/20 text-[#E6D793] rounded-full text-xs font-bold uppercase tracking-widest mb-6 border border-[#E6D793]/30 reveal-animation">
            {{ __('Warisan Kebaikan') }}
        </span>

        <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#E6D793] mb-6 reveal-animation leading-tight" style="text-shadow: 0 4px 20px rgba(0,0,0,0.8);">
            {{ __('Kisah Kami') }}
        </h1>
        <p class="text-[#FBF8ED]/80 text-base md:text-xl max-w-3xl mx-auto leading-relaxed reveal-animation" style="transition-delay: 100ms;">
            {{ __('Dari Dapur Sederhana, Menjadi Warisan Kebaikan untuk Indonesia.') }}
        </p>
    </div>
</section>

{{-- 2. STORY SECTION --}}
{{-- KONSISTENSI: Background & Padding disamakan dengan halaman lain (bg-mint-activity) --}}
<section class="pt-8 pb-16 md:pt-12 md:pb-24 bg-mint-activity relative overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-20 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        @forelse ($abouts as $item)
        {{-- UPDATE: max-w-5xl agar card tidak terlalu lebar di layar besar --}}
        <div class="mb-8 md:mb-16 reveal-animation max-w-5xl mx-auto" style="transition-delay: {{ $loop->iteration * 100 }}ms;">
            
            {{-- Card Style --}}
            <div class="bg-dark-card-activity rounded-2xl md:rounded-3xl overflow-hidden shadow-xl border border-[#1A3A24]/10">
                <div class="flex flex-col {{ $loop->even ? 'md:flex-row-reverse' : 'md:flex-row' }} items-stretch">
                    
                    {{-- Image Container --}}
                    {{-- ANALISA MOBILE: Tinggi gambar dibatasi (h-48) agar tidak memakan layar HP sepenuhnya --}}
                    <div class="md:w-5/12 h-48 md:h-auto relative overflow-hidden group">
                        <img src="{{ asset('storage/' . $item->image) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                             loading="lazy">
                        {{-- Overlay gradient tipis untuk estetika --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1A3A24]/60 to-transparent md:hidden"></div>
                    </div>
                    
                    {{-- Content Container --}}
                    {{-- UPDATE: Padding diperkecil (p-6 md:p-10) agar card terlihat lebih compact --}}
                    <div class="md:w-7/12 p-6 md:p-10 flex flex-col justify-center">
                        <div class="flex items-center gap-3 mb-3 md:mb-4">
                            <span class="px-3 py-1 bg-[#E6D793]/10 text-[#E6D793] rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest border border-[#E6D793]/20">
                                {{ $item->year_text }}
                            </span>
                        </div>

                        <h3 class="text-xl md:text-3xl font-serif font-bold text-[#FBF8ED] mb-4 leading-tight">
                            {{ $item->title }}
                        </h3>
                        
                        <div class="w-16 h-0.5 bg-[#E6D793]/50 mb-4 md:mb-6"></div>
                        
                        <p class="text-sm md:text-base text-[#FBF8ED]/80 leading-relaxed text-justify">
                            {{ $item->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-[#1A3A24]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="book-open" class="w-8 h-8 text-[#1A3A24]/40"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1A3A24] mb-2">{{ __('Belum ada cerita') }}</h3>
            <p class="text-gray-500 text-sm">{{ __('Cerita kami akan segera hadir.') }}</p>
        </div>
        @endforelse
    </div>
</section>

{{-- 3. "KEKUATAN DARI ALAM" SECTION --}}
{{-- KONSISTENSI: Menggunakan bg-elegant (Hijau Gelap) untuk kontras dengan section sebelumnya --}}
<section class="py-12 md:py-20 bg-elegant relative overflow-hidden">
    {{-- Dekorasi tambahan --}}
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#E6D793]/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#E6D793]/5 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="text-2xl md:text-4xl font-serif font-bold text-[#E6D793] reveal-animation mb-3">
            {{ __('Kekuatan dari Alam') }}
        </h2>
        <div class="w-16 h-1 bg-[#E6D793]/30 mx-auto rounded-full mb-4"></div>
        <p class="mb-10 md:mb-14 text-sm md:text-lg text-[#FBF8ED]/80 max-w-2xl mx-auto reveal-animation leading-relaxed">
            {{ __('Setiap tegukan D\'jamoe mengandung kebaikan dari rempah-rempah pilihan Indonesia.') }}
        </p>
        
        {{-- Grid Card Rempah --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 max-w-6xl mx-auto">
            
            {{-- Helper Component untuk Card Rempah --}}
            @php
                $spices = [
                    ['name' => 'Kunyit', 'icon' => 'leaf', 'desc' => 'Anti-inflamasi alami untuk tubuh.'],
                    ['name' => 'Jahe', 'icon' => 'sun', 'desc' => 'Menghangatkan & jaga imunitas.'],
                    ['name' => 'Kencur', 'icon' => 'flower-2', 'desc' => 'Redakan batuk & pegal linu.'],
                    ['name' => 'Temulawak', 'icon' => 'shield', 'desc' => 'Menjaga kesehatan fungsi hati.'],
                ];
            @endphp

            @foreach($spices as $spice)
            <div class="reveal-animation h-full" style="transition-delay: {{ ($loop->iteration * 100) + 200 }}ms;">
                {{-- UPDATE: Padding diperkecil (p-5) dan border diperhalus --}}
                <div class="bg-white/5 backdrop-blur-sm p-5 md:p-6 rounded-2xl h-full flex flex-col items-center justify-center group hover:bg-[#E6D793] transition-all duration-300 border border-[#E6D793]/20 hover:border-[#E6D793] shadow-lg hover:shadow-[#E6D793]/20">
                    
                    {{-- Icon --}}
                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-[#E6D793]/10 flex items-center justify-center mb-3 group-hover:bg-[#1A3A24]/10 transition-colors">
                        <i data-lucide="{{ $spice['icon'] }}" class="w-6 h-6 md:w-7 md:h-7 text-[#E6D793] group-hover:text-[#1A3A24] transition-colors"></i>
                    </div>
                    
                    <h3 class="text-base md:text-lg font-serif font-bold text-[#E6D793] mb-2 group-hover:text-[#1A3A24] transition-colors">
                        {{ __($spice['name']) }}
                    </h3>
                    
                    <p class="text-xs md:text-sm text-[#FBF8ED]/70 leading-relaxed group-hover:text-[#1A3A24]/80 transition-colors">
                        {{ __($spice['desc']) }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 4. CTA SECTION --}}
{{-- KONSISTENSI: Kembali ke background terang (bg-mint-activity) --}}
<section class="py-16 md:py-20 bg-mint-activity text-center relative overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-20 pointer-events-none"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="reveal-animation max-w-3xl mx-auto">
            <h2 class="text-2xl md:text-4xl font-serif font-bold text-[#1A3A24] mb-4">
                {{ __('Rasakan Khasiatnya Sekarang') }}
            </h2>
            <p class="mt-2 text-sm md:text-base text-[#1A3A24]/70 mb-8 leading-relaxed">
                {{ __('Temukan varian jamu yang diciptakan khusus untuk menemani hari Anda dengan kesehatan alami.') }}
            </p>
            <a href="{{ route('produk.index') }}" 
               class="inline-flex items-center gap-2 bg-[#1A3A24] text-[#E6D793] font-bold py-3 px-8 rounded-full shadow-lg hover:bg-[#0F2318] hover:scale-105 active:scale-95 transition-all duration-300 text-sm uppercase tracking-wider">
               {{ __('Lihat Semua Produk') }}
               <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</section>

@endsection