@extends('layouts.app')
@section('title', __('Temukan Kami') . " - D'jamoe")
@section('content')

{{-- HERO SECTION --}}
<section class="relative h-[60vh] bg-cover bg-center flex items-center justify-center text-center text-white" 
         style="background-image: linear-gradient(rgba(10, 28, 17, 0.7), rgba(10, 28, 17, 0.8)), url('{{ asset('gambar/gambar22.jpeg') }}');">
    <div class="reveal-animation">
        <h1 class="text-4xl md:text-7xl font-serif font-bold text-accent">{{ __('Temukan Kami') }}</h1>
    </div>
</section>

{{-- LOKASI MITRA --}}
<section class="py-12 md:py-24">
    <div class="container mx-auto px-4">

        {{-- Grid: 2 kolom di mobile, 3 kolom di desktop --}}
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            @forelse($locations as $location)
            
            <div class="bg-dark-card p-4 md:p-6 rounded-2xl shadow-lg flex flex-col reveal-animation" style="transition-delay: {{ $loop->iteration * 100 }}ms;">
                
                {{-- Title --}}
                <h3 class="text-lg md:text-xl font-serif font-bold text-accent mb-3">{{ $location->name }}</h3>
                
                {{-- Detail Lokasi --}}
                <div class="space-y-3 text-sm flex-grow">
                    <p class="flex items-start gap-3 text-light-text/80">
                        <i data-lucide="map-pin" class="w-4 h-4 mt-1 text-accent/80 flex-shrink-0"></i>
                        <span>{{ $location->address }}</span>
                    </p>
                    @if($location->phone_number)
                    <p class="flex items-center gap-3 text-light-text/80">
                        <i data-lucide="message-circle" class="w-4 h-4 text-accent/80 flex-shrink-0"></i>
                        <span>{{ $location->phone_number }}</span>
                    </p>
                    @endif
                </div>
                
                {{-- Tombol Petunjuk Arah (REVISI) --}}
                @if($location->google_maps_url)
                <a href="{{ $location->google_maps_url }}" target="_blank" 
                   class="mt-5 w-full text-center bg-primary/80 text-accent py-2 px-4 rounded-full 
                          hover:bg-accent hover:text-primary 
                          active:bg-accent active:text-primary {{-- 👈 PENAMBAHAN UNTUK MOBILE TAP FEEDBACK --}}
                          transition-colors duration-300 font-semibold 
                          text-xs md:text-sm"> {{-- 👈 PENYESUAIAN UKURAN FONT --}}
                    {{ __('Petunjuk Arah') }}
                </a>
                @endif
            </div>
            @empty
            <div class="col-span-full text-center py-12 md:py-16 text-accent/70">
                <p>{{ __('Belum ada lokasi mitra yang ditambahkan saat ini.') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection