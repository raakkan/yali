<template>
    <div class="group relative">
        <div
            class="relative inline-block bg-white h-16 w-16 md:h-24 md:w-24 rounded-lg ring-2 ring-gray-300 transition-transform duration-300 group-hover:z-10 hover:scale-125 hover:shadow-2xl hover:ring-3 hover:ring-gray-500 hover:relative">
            <div v-if="isImage" class="h-full w-full rounded-lg bg-cover bg-center"
                :style="{ 'background-image': `url(${file.url})` }"></div>
            <div v-else class="h-full w-full rounded-lg flex items-center justify-center bg-gray-200">
                <span class="text-gray-500">
                    {{ file.extension }}
                </span>
            </div>
            <button
                class="absolute top-0 right-0 bg-red-500 text-white ring-1 ring-gray-300 rounded-full p-0.5 mr-1 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                @click="removeFile">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <slot name="overlay"></slot>
        </div>
    </div>
</template>

<script setup lang="ts">
import { IFile } from '../../types';
import { useFileSelectStore } from '../../store/FileSelectStore';
import { computed } from 'vue';

const fileSelectStore = useFileSelectStore();

const props = defineProps<{
    file: IFile;
}>();

const isImage = computed(() => {
    const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    return imageExtensions.includes(props.file.extension.toLowerCase());
});

const removeFile = () => {
    fileSelectStore.deselectFile(props.file);
};
</script>
