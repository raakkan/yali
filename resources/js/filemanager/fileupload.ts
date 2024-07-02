import { createApp } from 'vue';
import { createPinia } from 'pinia';
import type { App } from 'vue';
import { vLazyLoad } from './directives/lazyLoad';
import FileManagerUpload from './FileManagerUpload.vue';

const app: App = createApp({});
const pinia = createPinia();

app.component('file-manager-upload', FileManagerUpload);

app.use(pinia);
app.mount('#file-manager-upload');