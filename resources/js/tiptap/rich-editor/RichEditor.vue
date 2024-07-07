<template>
    <div>
        <rich-editor-toolbar v-if="editor" :editor="editor" />
        <editor-content :editor="editor" class="border border-gray-300 rounded-b px-2" />
    </div>
</template>

<script>
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Link from '@tiptap/extension-link'
import { onMounted } from 'vue';
import RichEditorToolbar from './RichEditorToolbar.vue';

export default {
    components: {
        EditorContent,
        RichEditorToolbar
    },
    props: {
        content: {
            type: String,
        },
        formId: {
            type: String,
            required: true,
        },
        fieldName: {
            type: String,
            required: true,
        },
    },

    setup(props) {

        const editor = useEditor({
            content: props.content,
            extensions: [StarterKit, Link],
            onUpdate: ({ editor }) => {
                console.log(editor.getHTML());
            },
            onBlur({ editor, event }) {
                window.dispatchEvent(new CustomEvent('field-value-changed', {
                    detail: {
                        content: editor.getHTML(),
                        fieldName: props.fieldName,
                        formId: props.formId,
                    }
                }));
            },
        });

        onMounted(() => {
        });

        return { editor };
    }
}
</script>
