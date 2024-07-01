<template>
    <div>
        <button @click="showUploadDialog" class="btn btn-primary btn-sm flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                    clip-rule="evenodd" />
            </svg>
            <span class="hidden sm:inline-block ml-2">Upload File</span>
        </button>

        <Modal :is-visible="isUploaderOpen" icon-background-class="bg-blue-100">
            <template #icon>
                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
            </template>
            <template #title>Upload Files</template>
            <template #content>
                <div ref="dragDropArea" @drop.prevent="handleDrop" @dragover.prevent @dragenter.prevent
                    class="border-2 border-dashed border-gray-300 rounded-lg p-6 mb-4 text-center">
                    Drag and drop files here or
                    <input type="file" ref="fileInput" @change="handleFileSelect" multiple class="hidden" />
                    <button @click="$refs.fileInput.click()" class="text-blue-500 hover:underline">click to
                        select</button>
                </div>
                <div class="file-list space-y-2 mb-4">
                    <div v-for="(file, index) in files" :key="index"
                        class="bg-gray-100 p-2 rounded flex items-center justify-between">
                        <div class="flex-grow flex items-center">
                            <div v-if="file.isImage && file.preview" class="mr-2">
                                <img :src="file.preview" alt="Preview" class="w-10 h-10 object-cover rounded">
                            </div>
                            <div class="flex-grow">
                                <span class="font-semibold">{{ file.name }}</span> - {{ file.progress }}%
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" :style="{ width: `${file.progress}%` }">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button @click="removeFile(index)" class="ml-2 text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </template>
            <template #confirm-button>
                <button @click="startUpload" :disabled="!files.length || isUploading"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    <span v-if="isUploading">Uploading...</span>
                    <span v-else>Upload</span>
                </button>
            </template>
            <template #cancel-button>
                <button @click="closeUploader" :disabled="isUploading"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                    Cancel
                </button>
            </template>
        </Modal>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, reactive } from 'vue';
import { useFilemanagerStore } from '../store';
import Modal from './Modal.vue';
import axios from 'axios';

interface FileObject {
    name: string;
    file: File;
    progress: number;
    isImage: boolean;
    preview?: string;
}

export default defineComponent({
    name: 'UploadFileButton',
    components: { Modal },
    setup() {
        const store = useFilemanagerStore();
        const isUploaderOpen = ref(false);
        const files = ref<FileObject[]>([]);
        const isUploading = ref(false);
        const fileInput = ref<HTMLInputElement | null>(null);

        const showUploadDialog = () => {
            isUploaderOpen.value = true;
        };

        const closeUploader = () => {
            isUploaderOpen.value = false;
            files.value = [];
        };

        const handleFileSelect = (event: Event) => {
            const target = event.target as HTMLInputElement;
            if (target.files) {
                addFiles(Array.from(target.files));
            }
        };

        const handleDrop = (event: DragEvent) => {
            if (event.dataTransfer?.files) {
                addFiles(Array.from(event.dataTransfer.files));
            }
        };

        const addFiles = (newFiles: File[]) => {
            newFiles.forEach(file => {
                if (!files.value.some(f => f.name === file.name)) {
                    const isImage = file.type.startsWith('image/');
                    const fileObj: FileObject = reactive({
                        name: file.name,
                        file,
                        progress: 0,
                        isImage,
                        preview: undefined
                    });

                    if (isImage) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            fileObj.preview = e.target?.result as string;
                        };
                        reader.readAsDataURL(file);
                    }

                    files.value.push(fileObj);
                }
            });
        };

        const removeFile = (index: number) => {
            files.value.splice(index, 1);
            resetFileInput();
        };

        const resetFileInput = () => {
            if (fileInput.value) {
                fileInput.value.value = '';
            }
        };

        const startUpload = async () => {
            isUploading.value = true;
            for (const fileObj of files.value) {
                const formData = new FormData();
                formData.append('file', fileObj.file);
                formData.append('folder', store.currentFolder.path);

                try {
                    await axios.post('/api/admin/file-manager/upload', formData, {
                        headers: { 'Content-Type': 'multipart/form-data' },
                        onUploadProgress: (progressEvent) => {
                            if (progressEvent.total) {
                                fileObj.progress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                            }
                        },
                    });
                } catch (error) {
                    console.error('Upload error:', error);
                }
            }
            isUploading.value = false;
            store.refresh();
            closeUploader();
        };

        return {
            isUploaderOpen,
            files,
            isUploading,
            fileInput,
            showUploadDialog,
            closeUploader,
            handleFileSelect,
            handleDrop,
            removeFile,
            startUpload,
        };
    },
});
</script>