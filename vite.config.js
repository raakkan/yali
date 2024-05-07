import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default ({ mode }) => {
    process.env = { ...process.env, ...loadEnv(mode, path.join(__dirname, "../../../"), '') };

    return defineConfig({
        plugins: [
            laravel({
                hotFile: '../../../storage/vite.hot',
                input: ['resources/css/admin.css', 'resources/js/admin.js'],
                refresh: true,
            }),
        ],
        build: {
            outDir: path.join(__dirname, "/public/build/"),
        },
    });
}