import { createApp } from 'vue';
import { createPinia } from 'pinia';
import type { App } from 'vue';
import FileManagerComponent from './filemanager/FileManagerComponent.vue';
import { richEditorData } from './rich-editor';

declare global {
    interface Window {
        Alpine: any;
    }
}

document.addEventListener('alpine:init', () => {
    window.Alpine.data('richEditor', richEditorData);
});

const app: App = createApp({});
const pinia = createPinia();

app.component('file-manager-component', FileManagerComponent);

app.use(pinia);
app.mount('#app');

