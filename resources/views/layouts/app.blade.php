<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "D'jamoe - Warisan Rasa Tradisional Khas Madiun")</title>

    {{-- Memuat SEMUA aset yang sudah di-bundle oleh Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- === TAMBAHKAN KODE FAVICON ANDA DI SINI === --}}
    <link rel="icon" type="image/png" href="{{ asset('gambar/favicon.png') }}">

    {{-- Stack ini tetap ada untuk kasus darurat (misal: admin panel) --}}
    @stack('styles')
</head>
<body class="bg-dark-bg text-light-text min-h-screen flex flex-col overflow-x-hidden">

    @include('partials.navbar')

    <main class="flex-grow overflow-y-auto">
        @yield('content')
    </main>

    @include('partials.footer')

   {{-- Bubble WA adalah global --}}
<a href="https://wa.me/6282232279783?text={{ urlencode('Halo, saya tertarik dengan produk Djamoe.') }}"
   target="_blank"
   class="wa-bubble fixed bottom-6 right-6 z-50 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg transition-transform hover:scale-110">
    <img src="https://img.icons8.com/?size=100&id=BkugfgmBwtEI&format=png&color=000000" 
         alt="WhatsApp Logo" 
         class="w-8 h-8" />
</a>
    
    @stack('scripts')
</body>
</html>