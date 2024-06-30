<template>
    <div @click="selectFile" :class="['flex flex-col items-center p-2 rounded-lg transition-colors cursor-pointer',
        isSelected ? 'bg-blue-100' : 'hover:bg-gray-100']">
        <svg class="w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M21 8V20.9932C21 21.5501 20.5552 22 20.0066 22H3.9934C3.44495 22 3 21.556 3 21.0082V2.9918C3 2.45531 3.4487 2 4.00221 2H14.9968L21 8ZM19 9H14V4H5V20H19V9Z">
            </path>
            <text font-weight="bold" font-family="Arial, Helvetica, sans-serif" x="12" y="16" text-anchor="middle"
                font-size="6" fill="currentColor">{{ file.extension }}</text>
        </svg>
        <span class="mt-2 text-sm font-medium text-gray-700 text-center break-all">{{ file.name }}</span>
    </div>
</template>

<script lang="ts">
import { defineComponent, computed } from 'vue';
import { useFilemanagerStore } from '../store/FileManagerStore';
import { IFile } from '../types';

export default defineComponent({
    name: 'FileComponent',
    props: {
        file: {
            type: Object as () => IFile,
            required: true
        }
    },
    setup(props) {
        const store = useFilemanagerStore();
        const isSelected = computed(() => {
            return store.selectedItem?.path === props.file.path && store.selectedItem?.type === 'file';
        });

        const selectFile = () => {
            store.selectItem({ ...props.file, type: 'file' });
        };

        return { isSelected, selectFile };
    }
});
</script>