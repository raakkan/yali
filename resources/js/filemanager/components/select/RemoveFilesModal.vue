<template>
    <div v-if="isVisible" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50" @click="$emit('close')"></div>

        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-xl sm:w-full ">
                <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Remove Selected Files</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="$emit('close')">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="px-4 py-2 bg-slate-200">
                    <p class="text-gray-700">You have selected {{ selectedFiles.length }} files.</p>
                </div>
                <div class="p-4 max-h-64 md:max-h-96 overflow-y-auto">
                    <div class="grid grid-cols-3 md:grid-cols-4 gap-4">
                        <FileItem v-for="(file, index) in selectedFiles" :key="index" :file="file" />
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t ">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 mr-2"
                        @click="removeAllFiles">
                        Remove All
                    </button>
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        @click="$emit('close')">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { useFileSelectStore } from '../../store/FileSelectStore';
import FileItem from './FileItem.vue';

const props = defineProps<{
    isVisible: boolean;
}>();

const fileSelectStore = useFileSelectStore();
const selectedFiles = computed(() => fileSelectStore.selectedFiles);

const emit = defineEmits(['close']);

const removeAllFiles = () => {
    fileSelectStore.clearSelectedFiles();
    emit('close');
};

const removeFile = (file) => {
    fileSelectStore.deselectFile(file);
};
</script>
