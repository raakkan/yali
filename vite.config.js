import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import vue from '@vitejs/plugin-vue';

export default ({ mode }) => {
    process.env = { ...process.env, ...loadEnv(mode, path.join(__dirname, "../../../"), '') };

    return defineConfig({
        plugins: [
            laravel({
                hotFile: '../../../storage/vite.hot',
                input: ['resources/css/admin.css', 'resources/js/admin.ts', 'resources/js/filemanager/filemanager.ts', 'resources/js/filemanager/fileupload.ts'],
                refresh: true,
            }),
            vue(),
        ],
        build: {
            outDir: path.join(__dirname, "../../../public/build/"),
        },
        resolve: {
            alias: {
                'vue': 'vue/dist/vue.esm-bundler.js',
                '@': path.resolve(__dirname, './resources/js'),
            },
        },
    });
}