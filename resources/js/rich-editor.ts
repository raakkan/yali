import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit';

export function richEditorData(initialContent, formid, fieldname) {
    let editor = null;
    let content = initialContent;
    let wrapper = null;
    let formId = formid;
    let fieldName = fieldname;

    const debouncedUpdate = debounce(function () {
        if (wrapper) {
            wrapper.dispatchEvent(new CustomEvent('field-value-changed', {
                detail: { content: content, formId: formId, fieldName: fieldName },
                bubbles: true
            }));
        }
    }, 900);

    return {
        get editor() { return editor; },
        get content() { return content; },
        set content(value) {
            content = value;
            debouncedUpdate();
        },

        initEditor(wrapperElement, editorElement) {
            wrapper = wrapperElement;
            editor = new Editor({
                element: editorElement,
                extensions: [StarterKit],
                content: content,
                onUpdate: ({ editor }) => {
                    content = editor.getHTML();
                    debouncedUpdate();
                }
            });
        },

        toggleBold() {
            editor.chain().focus().toggleBold().run();
        },

        destroy() {
            if (editor) {
                editor.destroy();
            }
        }
    };
}

// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
