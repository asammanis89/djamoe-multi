{{-- Kelas 'sticky-header' dihapus agar JS 'app.js' tidak mengontrolnya (tidak menyembunyikannya saat scroll) --}}
<header class="sticky top-0 left-0 right-0 z-50 p-2 sm:p-4 transition-transform duration-300">
    <div class="container mx-auto flex justify-between items-center bg-primary/30 backdrop-blur-lg rounded-full text-white p-2 shadow-lg">
        <a href="{{ route('home') }}" class="flex-shrink-0">
            <img src="{{ asset('gambar/logo_dj.png') }}" alt="Logo D'jamoe" class="h-10 ml-2">
        </a>
        
        <nav class="hidden md:flex items-center gap-6 font-semibold">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'font-bold text-white' : 'text-accent/70 hover:text-white' }} transition-colors">{{ __('Beranda') }}</a>
            <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.index') ? 'font-bold text-white' : 'text-accent/70 hover:text-white' }} transition-colors">{{ __('Produk') }}</a>
            <a href="{{ route('aktivitas') }}" class="{{ request()->routeIs('aktivitas') ? 'font-bold text-white' : 'text-accent/70 hover:text-white' }} transition-colors">{{ __('Aktivitas') }}</a>
            <a href="{{ route('outlet') }}" class="{{ request()->routeIs('outlet') ? 'font-bold text-white' : 'text-accent/70 hover:text-white' }} transition-colors">{{ __('Temukan Kami') }}</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'font-bold text-white' : 'text-accent/70 hover:text-white' }} transition-colors">{{ __('Tentang Kami') }}</a>
        </nav>

        <div class="flex items-center gap-2">
            {{-- Language Switcher (Desktop) --}}
            <div class="hidden md:flex items-center gap-3 ml-4 mr-2">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @php
                        $flagCode = ($localeCode == 'en') ? 'gb' : $localeCode; 
                    @endphp
                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                       hreflang="{{ $localeCode }}"
                       rel="alternate"
                       title="{{ $properties['native'] }}"
                       class="transition-all duration-200 
                             @if($localeCode == LaravelLocalization::getCurrentLocale()) 
                                 opacity-100 transform scale-110
                             @else 
                                 opacity-50 hover:opacity-100 hover:scale-105
                             @endif"
                    >
                        {{-- 'flag-circle' adalah kelas global dari app.css --}}
                        <span class="fi fi-{{ $flagCode }} flag-circle"></span>
                    </a>
                @endforeach
            </div>
            
            <button id="mobile-menu-button" class="md:hidden p-2 rounded-full text-accent hover:bg-accent/10 transition-all mr-2">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </div>
</header>

{{-- Menu Mobile (HTML) --}}
<div id="mobile-menu" class="fixed top-20 right-4 z-[90] hidden transition-all duration-300">
    {{-- 'animate-slideDown' adalah kelas global dari app.css --}}
    <div class="bg-primary/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-accent/20 overflow-hidden min-w-[280px] animate-slideDown">
        
        <div class="bg-gradient-to-r from-primary to-primary/80 px-5 py-3 border-b border-accent/20">
            <h3 class="text-accent font-bold text-sm tracking-wide uppercase">{{ __('Menu Navigasi') }}</h3>
        </div>
        
        <div class="py-2">
            <a href="{{ route('home') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('home') ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10' }} transition-all group border-b border-accent/10">
                <i data-lucide="home" class="h-5 w-5 mr-3 {{ request()->routeIs('home') ? 'text-white' : 'text-accent/70 group-hover:text-accent' }}"></i>
                <span>{{ __('Beranda') }}</span>
                @if(request()->routeIs('home'))
                    <i data-lucide="chevron-right" class="h-4 w-4 ml-auto"></i>
                @endif
            </a>
            
            <a href="{{ route('produk.index') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('produk.index') ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10' }} transition-all group border-b border-accent/10">
                <i data-lucide="package" class="h-5 w-5 mr-3 {{ request()->routeIs('produk.index') ? 'text-white' : 'text-accent/70 group-hover:text-accent' }}"></i>
                <span>{{ __('Produk') }}</span>
                @if(request()->routeIs('produk.index'))
                    <i data-lucide="chevron-right" class="h-4 w-4 ml-auto"></i>
                @endif
            </a>
            
            <a href="{{ route('aktivitas') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('aktivitas') ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10' }} transition-all group border-b border-accent/10">
                <i data-lucide="calendar-heart" class="h-5 w-5 mr-3 {{ request()->routeIs('aktivitas') ? 'text-white' : 'text-accent/70 group-hover:text-accent' }}"></i>
                <span>{{ __('Aktivitas') }}</span>
                @if(request()->routeIs('aktivitas'))
                    <i data-lucide="chevron-right" class="h-4 w-4 ml-auto"></i>
                @endif
            </a>
            
            <a href="{{ route('outlet') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('outlet') ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10' }} transition-all group border-b border-accent/10">
                <i data-lucide="map-pin" class="h-5 w-5 mr-3 {{ request()->routeIs('outlet') ? 'text-white' : 'text-accent/70 group-hover:text-accent' }}"></i>
                <span>{{ __('Temukan Kami') }}</span>
                @if(request()->routeIs('outlet'))
                    <i data-lucide="chevron-right" class="h-4 w-4 ml-auto"></i>
                @endif
            </a>
            
            <a href="{{ route('about') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('about') ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10' }} transition-all group">
                <i data-lucide="info" class="h-5 w-5 mr-3 {{ request()->routeIs('about') ? 'text-white' : 'text-accent/70 group-hover:text-accent' }}"></i>
                <span>{{ __('Tentang Kami') }}</span>
                @if(request()->routeIs('about'))
                    <i data-lucide="chevron-right" class="h-4 w-4 ml-auto"></i>
                @endif
            </a>
        </div>

        {{-- Language Switcher (Mobile) --}}
        <div class="px-5 py-3 border-t border-accent/20">
            <h4 class="text-accent/70 font-semibold text-xs tracking-wide mb-2 uppercase">{{ __('Pilih Bahasa') }}</h4>
            <div class="flex items-center gap-3">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @php
                        $flagCode = ($localeCode == 'en') ? 'gb' : $localeCode;
                        $isActive = ($localeCode == LaravelLocalization::getCurrentLocale());
                    @endphp
                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                       hreflang="{{ $localeCode }}"
                       rel="alternate"
                       class="flex items-center gap-2 p-2 rounded-lg transition-all w-1/2 justify-center
                              {{ $isActive ? 'bg-accent/20 text-white font-bold' : 'text-accent hover:bg-accent/10' }}"
                    >
                        <span class="fi fi-{{ $flagCode }} flag-circle"></span>
                        <span class="text-sm font-medium">{{ $properties['native'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Overlay (HTML) --}}
<div id="mobile-menu-overlay" 
     class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[85] hidden md:hidden"
     onclick="document.getElementById('mobile-menu-button').click();">
</div>