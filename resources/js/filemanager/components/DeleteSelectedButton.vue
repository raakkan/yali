<template>
    <div>
        <button @click="showConfirmDialog"
            :class="['btn btn-sm transition-colors flex items-center justify-center', hasSelection ? 'btn-danger' : 'btn-disabled cursor-not-allowed']"
            :disabled="!hasSelection">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                </path>
            </svg>
            <span class="hidden sm:inline ml-2">Delete</span>
        </button>

        <Modal :is-visible="isConfirmDialogVisible" icon-background-class="bg-red-100">
            <template #icon>
                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </template>
            <template #title>
                Confirm {{ store.selectedItem?.type.charAt(0).toUpperCase() + store.selectedItem?.type.slice(1) }}
                Deletion
            </template>
            <template #content>
                <p class="text-sm text-gray-500">
                    Are you sure you want to delete the {{ store.selectedItem?.type.charAt(0).toUpperCase() +
                        store.selectedItem?.type.slice(1) }} "{{ store.selectedItem?.name }}"?
                </p>
            </template>
            <template #confirm-button>
                <button @click="confirmDelete" :disabled="isLoading"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                    <span v-if="isLoading">Deleting...</span>
                    <span v-else>Delete</span>
                </button>
            </template>
            <template #cancel-button>
                <button @click="cancelDelete" :disabled="isLoading"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                    Cancel
                </button>
            </template>
        </Modal>
    </div>
</template>

<script lang="ts">
import { defineComponent, computed, ref } from 'vue';
import { useFilemanagerStore } from '../store';
import axios from 'axios';
import Modal from './Modal.vue';

export default defineComponent({
    name: 'DeleteSelectedButton',
    components: { Modal },
    setup() {
        const store = useFilemanagerStore();
        const isConfirmDialogVisible = ref(false);
        const isLoading = ref(false);

        const hasSelection = computed(() => store.hasSelection);

        const showConfirmDialog = () => {
            isConfirmDialogVisible.value = true;
        };

        const cancelDelete = () => {
            isConfirmDialogVisible.value = false;
        };

        const confirmDelete = async () => {
            if (store.selectedItem) {
                isLoading.value = true;
                try {
                    const itemType = store.selectedItem.type;
                    console.log(itemType);

                    await axios.delete(`http://127.0.0.1:8000/api/admin/file-manager/delete/?type=${itemType}&path=${store.selectedItem.path}`);
                    isConfirmDialogVisible.value = false;
                    store.clearSelection();
                    await store.refresh();
                } catch (error) {
                    console.error('Error deleting item:', error);
                } finally {
                    isLoading.value = false;
                }
            }
        };

        return {
            store,
            hasSelection,
            isConfirmDialogVisible,
            isLoading,
            showConfirmDialog,
            cancelDelete,
            confirmDelete
        };
    }
});
</script>
