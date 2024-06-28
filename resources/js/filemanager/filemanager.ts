import { createApp } from 'vue';
import { createPinia } from 'pinia';
import FileManagerComponent from './components/component.vue';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
import type { App } from 'vue';

const app: App = createApp({});
const pinia = createPinia();

app.component('file-manager-component', FileManagerComponent);

app.component('Menu', Menu);
app.component('MenuButton', MenuButton);
app.component('MenuItems', MenuItems);
app.component('MenuItem', MenuItem);

app.use(pinia);
app.mount('#filemanager');
