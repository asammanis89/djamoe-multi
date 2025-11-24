import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Memaksa Vite mendengarkan di semua network interface
        hmr: {
            host: '127.0.0.1', // Memberitahu browser klien untuk konek ke 127.0.0.1
        }
    }
});
