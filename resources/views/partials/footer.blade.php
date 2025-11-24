<footer class="bg-black py-16">
    <div class="container mx-auto px-6 text-gray-300">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <div>
                <h3 class="font-bold text-lg mb-4 text-accent">{{ __('Alamat') }}</h3>
                <p class="text-gray-400">Jl. Ranumenggalan No.41, Mojorejo, Kec. Kartoharjo, <br>Kota Madiun, Jawa Timur 63119</p>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-4 text-accent">{{ __('Media Sosial') }}</h3>
                
                {{-- 
                    REVISI: 
                    Mengembalikan kode ke <img> .png asli Anda.
                    Ini adalah desain yang Anda inginkan dan sudah mencakup TikTok.
                --}}
                <div class="flex space-x-6 justify-center md:justify-start">
                    <a href="https://www.instagram.com/Djamoe_madiun" target="_blank" rel="noopener noreferrer" class="transition-transform hover:scale-110">
                        <img src="{{ asset('gambar/icons8-instagram-48.png') }}" alt="Instagram D'jamoe" class="w-10 h-10">
                    </a>
                    <a href="https://www.facebook.com/djamoe.madiun" target="_blank" rel="noopener noreferrer" class="transition-transform hover:scale-110">
                        <img src="{{ asset('gambar/icons8-facebook-48.png') }}" alt="Facebook D'jamoe" class="w-10 h-10">
                    </a>
                    <a href="https://api.whatsapp.com/send/?phone=6282232279783&text=Halo+saya+ingin+membeli+produk+Djamoe" target="_blank" rel="noopener noreferrer" class="transition-transform hover:scale-110">
                        <img src="{{ asset('gambar/icons8-whatsapp-48.png') }}" alt="WhatsApp D'jamoe" class="w-10 h-10">
                    </a>
                    <a href="https://www.tiktok.com/@djamoemadiun" target="_blank" rel="noopener noreferrer" class="transition-transform hover:scale-110">
                        <img src="{{ asset('gambar/icons8-tiktok-48.png') }}" alt="TikTok D'jamoe" class="w-10 h-10">
                    </a>
                </div>
                {{-- AKHIR REVISI --}}

            </div>
             <div>
                <h3 class="font-bold text-lg mb-4 text-accent">{{ __('Jam Buka') }}</h3>
                <p class="text-gray-400">{{ __('Senin - Jumat') }}: 08:00 - 17:00</p>
                <p class="text-gray-400">{{ __('Sabtu') }}: 09:00 - 15:00</p>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-700 pt-8 text-center text-gray-400 text-sm">
            &copy; {{ date('Y') }} D'jamoe. {{ __('Warisan Sehat dari Madiun.') }}
        </div>
    </div>
</footer>