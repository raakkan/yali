<template>
    <div @click="handleClick" :class="['flex flex-col items-center w-16 md:w-20 p-2 rounded-lg transition-colors cursor-pointer relative group',
        isSelected ? 'bg-blue-100' : 'hover:bg-gray-100']">
        <div v-if="imageUrl" class="w-12 h-12 md:w-16 md:h-16 overflow-hidden">
            <img :src="imageUrl" loading="lazy" alt="Thumbnail" class="w-full h-full object-cover">
        </div>
        <svg v-else class="w-12 h-12 md:w-16 md:h-16 text-gray-400" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M21 8V20.9932C21 21.5501 20.5552 22 20.0066 22H3.9934C3.44495 22 3 21.556 3 21.0082V2.9918C3 2.45531 3.4487 2 4.00221 2H14.9968L21 8ZM19 9H14V4H5V20H19V9Z">
            </path>
            <text font-weight="bold" font-family="Arial, Helvetica, sans-serif" x="12" y="16" text-anchor="middle"
                font-size="6" fill="currentColor">{{ file.extension }}</text>
        </svg>
        <span class="mt-2 text-sm font-medium text-gray-700 text-center break-all line-clamp-1">{{ file.name }}</span>

        <div v-if="select && isSelectable"
            class="absolute inset-0 bg-blue-500 bg-opacity-75 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
            <span v-if="!isFileSelected" class="text-white font-bold">Add</span>
            <span v-else class="text-white font-bold" @click.stop="removeFile">Remove</span>
        </div>

    </div>
</template>

<script lang="ts">
import { defineComponent, computed } from 'vue';
import { useFilemanagerStore } from '../store/FileManagerStore';
import { useFileSelectStore } from '../store/FileSelectStore';
import { IFile } from '../types';

export default defineComponent({
    name: 'FileComponent',
    props: {
        file: {
            type: Object as () => IFile,
            required: true
        },
        select: {
            type: Boolean,
            default: false
        }
    },
    emits: ['file-selected'],
    setup(props) {
        const store = useFilemanagerStore();
        const fileSelectStore = useFileSelectStore();

        const isSelected = computed(() => {
            return store.selectedItem?.path === props.file.path && store.selectedItem?.type === 'file';
        });

        const selectFile = () => {
            if (!props.select) {
                store.selectItem({ ...props.file, type: 'file' });
            }
        };

        const handleClick = () => {
            if (props.select) {
                fileSelectStore.selectFile(props.file);
            } else {
                selectFile();
            }
        };

        const isFileSelected = computed(() => {
            return fileSelectStore.isFileSelected(props.file);
        });

        const removeFile = () => {
            fileSelectStore.deselectFile(props.file);
        };

        const imageUrl = computed(() => {
            const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            const extension = props.file.extension.toLowerCase();

            if (props.file.thumbnails) {
                console.log(props.file.thumbnails);

                return props.file.thumbnails.small_thumb.url;
            }

            if (imageExtensions.includes(extension)) {
                return props.file.url;
            }

            return null;
        });

        const isSelectable = computed(() => {
            return fileSelectStore.canSelectFile(props.file);
        });

        return { isSelected, handleClick, imageUrl, selectFile, isFileSelected, removeFile, isSelectable };
    }
});
</script>
