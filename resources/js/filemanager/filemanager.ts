import { createApp } from 'vue';
import { createPinia } from 'pinia';
import FileManagerComponent from './FileManagerComponent.vue';
import type { App } from 'vue';

const app: App = createApp({});
const pinia = createPinia();

app.component('file-manager-component', FileManagerComponent);

app.use(pinia);
app.mount('#filemanager');
