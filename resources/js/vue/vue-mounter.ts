import { createApp } from 'vue';
import { createPinia } from 'pinia';
import FileManagerComponent from '../filemanager/FileManagerComponent.vue';
import RichEditor from '../tiptap/rich-editor/RichEditor.vue';

const vueElements = document.querySelectorAll('[data-vue]');

if (vueElements.length > 0) {
    vueElements.forEach((element) => {
        const id = element.getAttribute('id');

        const dataVue = element.getAttribute('data-vue');

        if (id) {
            const app = createApp({});
            const pinia = createPinia();

            if (dataVue && dataVue === 'file-manager') {
                app.component('file-manager-component', FileManagerComponent);

                app.use(pinia);
            }

            if (dataVue && dataVue === 'rich-editor') {
                app.component('rich-editor', RichEditor);
            }

            app.mount(`#${id}`);
        } else {
            console.error('Vue element has no ID');
        }
    });
} else {
    console.log('No Vue elements found');
}
