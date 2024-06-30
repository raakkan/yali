<template>
    <div>
        <button @click="showConfirmDialog"
            class="flex items-center px-4 py-2 rounded text-white transition-colors bg-blue-500 hover:bg-blue-600">
            <span>New Folder</span>
        </button>

        <Modal :is-visible="isConfirmDialogVisible" icon-background-class="bg-blue-100">
            <template #icon>
                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </template>
            <template #title>Create New Folder</template>
            <template #content>
                <input v-model="folderName" type="text" placeholder="Folder Name"
                    class="w-full p-2 border rounded mb-2">
                <p v-if="errorMessage" class="text-red-500 text-sm">{{ errorMessage }}</p>
            </template>
            <template #confirm-button>
                <button @click="createFolder" :disabled="isLoading"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                    <span v-if="isLoading">Creating...</span>
                    <span v-else>Create</span>
                </button>
            </template>
            <template #cancel-button>
                <button @click="cancelCreate" :disabled="isLoading"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                    Cancel
                </button>
            </template>
        </Modal>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { useFilemanagerStore } from '../store';
import axios from 'axios';
import Modal from './Modal.vue';

export default defineComponent({
    name: 'CreateFolderButton',
    components: { Modal },
    setup() {
        const store = useFilemanagerStore();
        const folderName = ref('');
        const errorMessage = ref('');
        const isConfirmDialogVisible = ref(false);
        const isLoading = ref(false);

        const validateFolderName = (name: string): string | null => {
            if (!name.trim()) {
                return "Folder name cannot be empty.";
            }
            if (name.length > 255) {
                return "Folder name is too long (max 255 characters).";
            }
            if (!/^[a-zA-Z0-9_\-\s]+$/.test(name)) {
                return "Folder name can only contain letters, numbers, spaces, underscores, and hyphens.";
            }
            return null;
        };

        const showConfirmDialog = () => {
            isConfirmDialogVisible.value = true;
        };

        const cancelCreate = () => {
            folderName.value = '';
            errorMessage.value = '';
            isConfirmDialogVisible.value = false;
        };

        const createFolder = async () => {
            const validationError = validateFolderName(folderName.value);
            if (validationError) {
                errorMessage.value = validationError;
                return;
            }

            isLoading.value = true;
            try {
                const parentPath = store.currentFolder ? store.currentFolder.path : '';
                await axios.post('http://127.0.0.1:8000/api/admin/file-manager/folders', {
                    name: folderName.value.trim(),
                    parent: parentPath
                });

                await store.refresh();

                folderName.value = '';
                errorMessage.value = '';
                isConfirmDialogVisible.value = false;
            } catch (error) {
                errorMessage.value = (error as Error).message;
                console.error('Error creating folder:', error);
            } finally {
                isLoading.value = false;
            }
        };

        return {
            folderName,
            errorMessage,
            isConfirmDialogVisible,
            isLoading,
            showConfirmDialog,
            cancelCreate,
            createFolder
        };
    }
});
</script>
