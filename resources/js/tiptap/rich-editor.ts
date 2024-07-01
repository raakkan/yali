import { Editor, EditorOptions } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit';
import Underline from '@tiptap/extension-underline';
import Link from '@tiptap/extension-link';
import Image from '@tiptap/extension-image';
import ResetFormattingOnSpace from './extensions/ResetFormattingOnSpace';

interface RichEditorData {
    editor: Editor | null;
    content: string;
    initEditor: (wrapperElement: HTMLElement, editorElement: HTMLElement) => void;
    toggleBold: () => void;
    toggleItalic: () => void;
    toggleLink: () => void;
    toggleCode: () => void;
    toggleUnderline: () => void;
    toggleStrike: () => void;
    destroy: () => void;
    activeStates: Record<string, boolean>;
    updateActiveStates: () => void;
    insertImage: (url: string, alt?: string) => void;
}

export function richEditorData(initialContent: string, formid: string, fieldname: string): RichEditorData {
    let editor: Editor | null = null;
    let content: string = initialContent;
    let wrapper: HTMLElement | null = null;
    const formId: string = formid;
    const fieldName: string = fieldname;
    let activeStates = {
        bold: false,
        italic: false,
        link: false,
        code: false,
        underline: false,
        strike: false,
    };

    const debouncedUpdate = debounce(function () {
        if (wrapper) {
            wrapper.dispatchEvent(new CustomEvent('field-value-changed', {
                detail: { content: content, formId: formId, fieldName: fieldName },
                bubbles: true
            }));
        }
    }, 900);

    return {
        get editor(): Editor | null { return editor; },
        get content(): string { return content; },
        activeStates,
        set content(value: string) {
            content = value;
            debouncedUpdate();
        },

        initEditor(wrapperElement: HTMLElement, editorElement: HTMLElement): void {
            wrapper = wrapperElement;
            const editorOptions: Partial<EditorOptions> = {
                element: editorElement,
                extensions: [
                    StarterKit,
                    Underline,
                    Link.configure({
                        openOnClick: false,
                    }),
                    Image,
                    ResetFormattingOnSpace
                ],
                content: content,
                onUpdate: ({ editor }) => {
                    content = editor.getHTML();
                    debouncedUpdate();
                    this.updateActiveStates();
                },
                onSelectionUpdate: ({ editor }) => {
                    this.updateActiveStates();
                },
            };
            editor = new Editor(editorOptions);
            this.updateActiveStates();
        },

        updateActiveStates(): void {
            if (editor) {
                this.activeStates.bold = editor.isActive('bold');
                this.activeStates.italic = editor.isActive('italic');
                this.activeStates.link = editor.isActive('link');
                this.activeStates.code = editor.isActive('code');
                this.activeStates.underline = editor.isActive('underline');
                this.activeStates.strike = editor.isActive('strike');
            }
        },

        toggleBold(): void {
            editor?.chain().focus().toggleBold().run();
            this.updateActiveStates();
        },

        toggleItalic(): void {
            editor?.chain().focus().toggleItalic().run();
            this.updateActiveStates();
        },

        toggleLink(): void {
            const url = window.prompt('Enter the URL');
            if (url) {
                editor?.chain().focus().setLink({ href: url }).run();
            } else {
                editor?.chain().focus().unsetLink().run();
            }
            this.updateActiveStates();
        },

        toggleCode(): void {
            editor?.chain().focus().toggleCode().run();
            this.updateActiveStates();
        },

        toggleUnderline(): void {
            editor?.chain().focus().toggleUnderline().run();
            this.updateActiveStates();
        },

        toggleStrike(): void {
            editor?.chain().focus().toggleStrike().run();
            this.updateActiveStates();
        },

        insertImage(): void {
            const url = prompt('Enter the URL of the image:');
            if (url) {
                editor?.chain().focus().setImage({ src: url }).run();
            }
        },

        destroy(): void {
            if (editor) {
                editor.destroy();
            }
        },
    };
}

// Debounce function
function debounce<F extends (...args: any[]) => any>(func: F, wait: number): (...args: Parameters<F>) => void {
    let timeout: ReturnType<typeof setTimeout> | null;
    return function executedFunction(...args: Parameters<F>): void {
        const later = () => {
            if (timeout !== null) {
                clearTimeout(timeout);
            }
            func(...args);
        };
        if (timeout !== null) {
            clearTimeout(timeout);
        }
        timeout = setTimeout(later, wait);
    };
}
