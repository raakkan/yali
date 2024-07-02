<template>
    <div class="flex items-center">
        <div v-if="selectedFiles.length > 0" class="flex -space-x-10 md:-space-x-16 relative">
            <div v-for="(file, index) in selectedFiles.slice(0, 6)" :key="file.path" class="relative">
                <FileItem :file="file" />
            </div>
            <FileItem v-if="selectedFiles.length > 6" :file="selectedFiles[5]">
                <template #overlay>
                    <div class="absolute top-0 left-0 flex items-center justify-center h-16 w-16 md:h-24 md:w-24 rounded-lg bg-gray-500 text-white transition-transform duration-300 hover:scale-110 hover:shadow-lg cursor-pointer"
                        @click="showModal = true">
                        +{{ selectedFiles.length - 6 }}
                    </div>
                </template>
            </FileItem>
        </div>
        <div v-else class="flex flex-row items-center">
            <div
                class="flex items-center justify-center h-16 w-16 md:h-24 md:w-24 rounded-lg bg-gray-200 text-gray-500">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <span class="ml-2 text-gray-500">No files selected</span>
        </div>
        <RemoveFilesModal v-if="showModal" :isVisible="showModal" @close="showModal = false" />
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { useFileSelectStore } from '../../store/FileSelectStore';
import FileItem from './FileItem.vue';
import RemoveFilesModal from './RemoveFilesModal.vue';

const fileSelectStore = useFileSelectStore();
const selectedFiles = computed(() => fileSelectStore.selectedFiles);
const showModal = ref(false);
</script>
