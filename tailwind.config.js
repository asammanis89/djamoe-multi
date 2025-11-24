/** @type {import('tailwindcss').Config} */
export default {
  // 1. Beritahu Tailwind file apa saja yang perlu dipindai
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],

  // 2. Definisikan tema kustom Anda
  theme: {
    extend: {
        colors: {
            'primary': '#154424', 
            'accent': '#E6D793', 
            'dark-bg': '#0a1c11',
            'dark-card': '#1a3a24', 
            'light-text': '#FBF8ED',
        },
        fontFamily: {
            'sans': ['Inter', 'sans-serif'],
            'serif': ['Playfair Display', 'serif'],
        }
    },
  },
  
  // 3. TAMBAHAN PENTING (SAAT PINDAH DARI CDN)
  // Ini adalah "daftar aman" agar Vite tidak membuang kelas dinamis Anda
  safelist: [
    'filter',
    'grayscale',
    'invert',
    // Ini adalah pola regex untuk menemukan semua kelas text-accent/xx
    {
      pattern: /^(text-accent|text-light-text)\/(70|80|90)$/,
    },
  ],

  plugins: [],
}