import { richEditorData } from './tiptap/rich-editor';

declare global {
    interface Window {
        Alpine: any;
    }
}

document.addEventListener('alpine:init', () => {
    window.Alpine.data('richEditor', richEditorData);
});

