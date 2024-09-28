import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        port: 3000, // Change the port to 3000 or any available port
        host: 'localhost' // You can also set this to '0.0.0.0' to listen on all interfaces
    }
});
