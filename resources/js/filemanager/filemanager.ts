import { createApp } from 'vue';
import { createPinia } from 'pinia';
import type { App } from 'vue';
import FileManagerComponent from './FileManagerComponent.vue';

const app: App = createApp({});
const pinia = createPinia();

app.component('file-manager-component', FileManagerComponent);

app.use(pinia);
app.mount('#file-manager');
