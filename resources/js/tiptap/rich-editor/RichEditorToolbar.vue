<template>
    <div class="border-x border-t border-gray-300 rounded-t p-1.5 space-x-2">
        <button v-if="bold" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('bold') }"
            @click="editor.chain().focus().toggleBold().run()" title="Bold">
            <b>B</b>
        </button>
        <button v-if="italic" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('italic') }"
            @click="editor.chain().focus().toggleItalic().run()" title="Italic">
            <i>I</i>
        </button>
        <button v-if="strike" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('strike') }"
            @click="editor.chain().focus().toggleStrike().run()" title="Strike">
            S
        </button>
        <button v-if="code" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('code') }"
            @click="editor.chain().focus().toggleCode().run()" title="Code">
            <code>C</code>
        </button>
        <button v-if="blockquote" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('blockquote') }"
            @click="editor.chain().focus().toggleBlockquote().run()" title="Blockquote">
            &ldquo;
        </button>
        <button v-if="bulletList" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('bulletList') }"
            @click="editor.chain().focus().toggleBulletList().run()" title="Bullet List">
            &bull;
        </button>
        <button v-if="orderedList" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('orderedList') }"
            @click="editor.chain().focus().toggleOrderedList().run()" title="Ordered List">
            1.
        </button>
        <button v-if="link" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('link') }" @click="setLink" title="Link">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
            </svg>
        </button>
        <button v-if="underline" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('underline') }"
            @click="editor.chain().focus().toggleUnderline().run()" title="Underline">
            <u>U</u>
        </button>
        <button v-if="horizontalRule" type="button" class="px-2 py-0.5 rounded border"
            @click="editor.chain().focus().setHorizontalRule().run()" title="Horizontal Rule">
            &mdash;
        </button>
        <button v-if="heading" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('heading', { level: 1 }) }"
            @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" title="Heading 1">
            H1
        </button>
        <button v-if="heading" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('heading', { level: 2 }) }"
            @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" title="Heading 2">
            H2
        </button>
        <button v-if="heading" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('heading', { level: 3 }) }"
            @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" title="Heading 3">
            H3
        </button>
        <button v-if="codeBlock" type="button" class="px-2 py-0.5 rounded border"
            :class="{ 'bg-blue-500 text-white': editor.isActive('codeBlock') }"
            @click="editor.chain().focus().toggleCodeBlock().run()" title="Code Block">
            &lt;&gt;
        </button>
    </div>
</template>

<script>

export default {
    props: {
        editor: {
            type: Object,
            required: true,
        },
        bold: {
            type: Boolean,
            default: true,
        },
        italic: {
            type: Boolean,
            default: true,
        },
        strike: {
            type: Boolean,
            default: true,
        },
        code: {
            type: Boolean,
            default: true,
        },
        blockquote: {
            type: Boolean,
            default: true,
        },
        bulletList: {
            type: Boolean,
            default: true,
        },
        orderedList: {
            type: Boolean,
            default: true,
        },
        link: {
            type: Boolean,
            default: true,
        },
        underline: {
            type: Boolean,
            default: true,
        },
        horizontalRule: {
            type: Boolean,
            default: true,
        },
        heading: {
            type: Boolean,
            default: true,
        },
        codeBlock: {
            type: Boolean,
            default: true,
        },
    },
    methods: {
        setLink() {
            const url = window.prompt('URL');
            if (url) {
                this.editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
            }
        },
    },
};
</script>