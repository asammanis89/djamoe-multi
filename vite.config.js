import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/pages/home.css',
                'resources/css/pages/produk.css',
                'resources/css/pages/aktivitas.css',
                'resources/css/pages/about.css',
                'resources/css/pages/outlet.css',
                'resources/js/pages/produk-ajax.js',
                'resources/js/pages/aktivitas-modal.js',
                'resources/js/pages/outlet.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
        manifest: true,
        minify: 'terser',
    },
    server: {
        host: '0.0.0.0', // Memaksa Vite mendengarkan di semua network interface
        hmr: {
            host: '127.0.0.1', // Memberitahu browser klien untuk konek ke 127.0.0.1
        }
    }
});
