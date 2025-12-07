<header class="fixed top-4 left-0 right-0 z-50 px-4 transition-all duration-300 font-sans">
    
    {{-- Container Utama --}}
    <div class="container mx-auto max-w-6xl flex justify-between items-center 
                bg-[#051F1A]/80 backdrop-blur-md border border-white/10 
                rounded-full text-white py-3 px-6 shadow-2xl">
        
        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex-shrink-0 hover:opacity-80 transition-opacity">
            <img src="{{ asset('gambar/logo_dj.png') }}" alt="Logo D'jamoe" class="h-10 ml-2">
        </a>
        
        {{-- MENU DESKTOP --}}
        <nav class="hidden md:flex items-center gap-8 font-medium text-base tracking-wide">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-accent font-bold' : 'text-gray-300 hover:text-white' }} transition-colors">{{ __('Beranda') }}</a>
            <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.index') ? 'text-accent font-bold' : 'text-gray-300 hover:text-white' }} transition-colors">{{ __('Produk') }}</a>
            <a href="{{ route('aktivitas') }}" class="{{ request()->routeIs('aktivitas') ? 'text-accent font-bold' : 'text-gray-300 hover:text-white' }} transition-colors">{{ __('Aktivitas') }}</a>
            <a href="{{ route('outlet') }}" class="{{ request()->routeIs('outlet') ? 'text-accent font-bold' : 'text-gray-300 hover:text-white' }} transition-colors">{{ __('Temukan Kami') }}</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-accent font-bold' : 'text-gray-300 hover:text-white' }} transition-colors">{{ __('Tentang Kami') }}</a>
        </nav>

        {{-- BAGIAN KANAN (BAHASA & BURGER) --}}
        <div class="flex items-center gap-4">
            
            {{-- 2 BENDERA BULAT (DESKTOP) --}}
            <div class="hidden md:flex items-center gap-3 ml-2 pl-4 h-6">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if(in_array($localeCode, ['id', 'en'])) 
                        @php $flagCode = ($localeCode == 'en') ? 'gb' : $localeCode; @endphp
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                           class="transition-all duration-200 hover:scale-110 {{ $localeCode == LaravelLocalization::getCurrentLocale() ? 'opacity-100 grayscale-0' : 'opacity-40 hover:opacity-100 grayscale' }}"
                           title="{{ $properties['native'] }}">
                            <span class="fi fi-{{ $flagCode }} w-6 h-6 rounded-full shadow-sm block bg-cover flex-shrink-0"></span>
                        </a>
                    @endif
                @endforeach
            </div>
            
            {{-- Tombol Mobile --}}
            <button id="mobile-menu-button" class="md:hidden p-2 rounded-full text-white hover:bg-white/10 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
            </button>
        </div>
    </div>
</header>

{{-- MENU MOBILE --}}
<div id="mobile-menu" class="fixed top-24 right-4 z-[90] hidden transition-all duration-300 origin-top-right font-sans">
    <div class="bg-[#051F1A]/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden w-[300px] animate-slideDown">
        
        {{-- Header Menu Mobile --}}
        <div class="bg-white/5 px-6 py-4 border-b border-white/5 flex justify-between items-center">
            
            <h3 class="text-white font-bold text-base tracking-widest uppercase">
                {{ __('MENU') }} 
            </h3>
        </div>
        
        {{-- List Link Mobile (Perbaikan konsistensi teks) --}}
        <div class="flex flex-col py-2">
            <a href="{{ route('home') }}" class="px-6 py-3.5 text-sm font-medium flex justify-between items-center group transition-colors {{ request()->routeIs('home') ? 'text-accent bg-white/5' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                {{ __('Beranda') }} @if(request()->routeIs('home')) <div class="w-2 h-2 rounded-full bg-accent"></div> @endif
            </a>
            <a href="{{ route('produk.index') }}" class="px-6 py-3.5 text-sm font-medium flex justify-between items-center group transition-colors {{ request()->routeIs('produk.index') ? 'text-accent bg-white/5' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                {{ __('Produk') }} @if(request()->routeIs('produk.index')) <div class="w-2 h-2 rounded-full bg-accent"></div> @endif
            </a>
            <a href="{{ route('aktivitas') }}" class="px-6 py-3.5 text-sm font-medium flex justify-between items-center group transition-colors {{ request()->routeIs('aktivitas') ? 'text-accent bg-white/5' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                {{ __('Aktivitas') }} @if(request()->routeIs('aktivitas')) <div class="w-2 h-2 rounded-full bg-accent"></div> @endif
            </a>
            <a href="{{ route('outlet') }}" class="px-6 py-3.5 text-sm font-medium flex justify-between items-center group transition-colors {{ request()->routeIs('outlet') ? 'text-accent bg-white/5' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                {{ __('Temukan Kami') }} @if(request()->routeIs('outlet')) <div class="w-2 h-2 rounded-full bg-accent"></div> @endif
            </a>
            <a href="{{ route('about') }}" class="px-6 py-3.5 text-sm font-medium flex justify-between items-center group transition-colors {{ request()->routeIs('about') ? 'text-accent bg-white/5' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                {{ __('Tentang Kami') }} @if(request()->routeIs('about')) <div class="w-2 h-2 rounded-full bg-accent"></div> @endif
            </a>
            
            {{-- Language Switcher di Bawah, 2 Kolom (Perbaikan bendera bulat & teks) --}}
            <div class="border-t border-white/5 mt-2 pt-4 px-6 grid grid-cols-2 gap-4 pb-4">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if(in_array($localeCode, ['id', 'en'])) 
                        @php 
                            $flagCode = ($localeCode == 'en') ? 'gb' : $localeCode; 
                            // Ubah agar selalu menampilkan "Indonesia" atau "English"
                            $langName = ($localeCode == 'id') ? 'Indonesia' : 'English'; 
                        @endphp
                        
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                           class="flex items-center justify-center gap-2 py-2 px-2 rounded-lg transition-all text-sm
                                  {{ $localeCode == LaravelLocalization::getCurrentLocale() 
                                     ? 'bg-accent/20 text-accent font-semibold border border-accent/40 scale-[1.02]' 
                                     : 'bg-white/5 text-gray-300 hover:bg-white/10' }}">
                           
                            {{-- Bendera Bulat (memastikan ukuran sama & object-cover) --}}
                            <span class="fi fi-{{ $flagCode }} w-6 h-6 rounded-full block bg-cover flex-shrink-0"></span>
                            
                            {{-- Nama Bahasa (memastikan teks tidak terpotong) --}}
                            <span class="font-medium whitespace-nowrap overflow-hidden text-ellipsis">
                                {{ $langName }}
                            </span>
                        </a>
                    @endif
                @endforeach
            </div>
            
        </div>
    </div>
</div>

<div id="mobile-menu-overlay" 
     class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[85] hidden md:hidden transition-opacity duration-300"
     onclick="toggleMobileMenu()">
</div>

{{-- SCRIPT PENANGKAL ERROR --}}
<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-menu-overlay');
        if (menu && overlay) {
            menu.classList.toggle('hidden');
            overlay.classList.toggle('hidden');
        }
    }

    // Menggunakan Event Listener dengan Pengecekan Null (Anti Error Console)
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-button');
        if(btn) {
            // Hapus listener lama jika ada (trik clone)
            const newBtn = btn.cloneNode(true);
            btn.parentNode.replaceChild(newBtn, btn);
            
            newBtn.addEventListener('click', toggleMobileMenu);
        }
    });
</script>