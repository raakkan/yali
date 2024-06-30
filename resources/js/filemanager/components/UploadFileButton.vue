<template>
    <div class="upload-file-button">
        <button @click="openUploader" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Upload File
        </button>
        <div v-if="isUploaderOpen"
            class="fixed inset-0 z-50 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
            <div class="relative bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-auto">
                <h2 class="text-2xl font-bold mb-4">Upload Files</h2>
                <div ref="dragDropArea" class="border-2 border-dashed border-gray-300 rounded-lg p-6 mb-4 text-center">
                    Drag and drop files here or click to select
                </div>
                <div class="file-list space-y-2 mb-4">
                    <div v-for="file in files" :key="file.id" class="bg-gray-100 p-2 rounded">
                        <span class="font-semibold">{{ file.name }}</span> - {{ file.progress }}%
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" :style="{ width: `${file.progress}%` }"></div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <button @click="startUpload" :disabled="!files.length"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded disabled:opacity-50 disabled:cursor-not-allowed">
                        Start Upload
                    </button>
                    <button @click="closeUploader"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, onUnmounted, nextTick } from 'vue';
import { useFilemanagerStore } from '../store';
import Uppy from '@uppy/core';
import XHRUpload from '@uppy/xhr-upload';
import DragDrop from '@uppy/drag-drop';

export default defineComponent({
    name: 'UploadFileButton',
    setup() {
        const store = useFilemanagerStore();
        const uppy = ref<Uppy | null>(null);
        const isUploaderOpen = ref(false);
        const files = ref([]);
        const dragDropArea = ref<HTMLElement | null>(null);

        const initializeUppy = () => {
            if (dragDropArea.value) {
                uppy.value = new Uppy({
                    debug: true,
                    autoProceed: false,
                })
                    .use(DragDrop, {
                        target: dragDropArea.value,
                    })
                    .use(XHRUpload, {
                        endpoint: '/api/admin/file-manager/upload',
                        fieldName: 'file',
                        formData: true,
                    });

                uppy.value.on('file-added', (file) => {
                    files.value.push({ id: file.id, name: file.name, progress: 0 });
                });

                uppy.value.on('upload-progress', (file, progress) => {
                    const fileIndex = files.value.findIndex((f) => f.id === file.id);
                    if (fileIndex !== -1) {
                        files.value[fileIndex].progress = Math.round(progress.bytesUploaded / progress.bytesTotal * 100);
                    }
                });

                uppy.value.on('upload-success', (file, response) => {
                    store.refresh();
                });
            }
        };

        onMounted(() => {
            nextTick(() => {
                if (isUploaderOpen.value) {
                    initializeUppy();
                }
            });
        });

        onUnmounted(() => {
            if (uppy.value) {
                uppy.value.close();
            }
        });

        const openUploader = () => {
            isUploaderOpen.value = true;
            nextTick(() => {
                initializeUppy();
            });
        };

        const closeUploader = () => {
            isUploaderOpen.value = false;
            files.value = [];
            if (uppy.value) {
                uppy.value.reset();
            }
        };

        const startUpload = () => {
            if (uppy.value) {
                uppy.value.upload();
            }
        };

        return {
            isUploaderOpen,
            files,
            dragDropArea,
            openUploader,
            closeUploader,
            startUpload,
        };
    },
});
</script>