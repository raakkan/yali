<template>
    <div>
        <button @click="showConfirmDialog"
            :class="['flex items-center px-4 py-2 rounded text-white transition-colors', hasSelection ? 'bg-red-500 hover:bg-red-600' : 'bg-gray-500 cursor-not-allowed']"
            :disabled="!hasSelection">
            <span>Delete</span>
        </button>

        <div v-if="isConfirmDialogVisible"
            class="fixed inset-0 z-50 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
            <div class="bg-white rounded-lg p-4 w-full max-w-md m-4">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            Confirm {{ store.selectedItem?.type.charAt(0).toUpperCase() +
                                store.selectedItem?.type.slice(1) }} Deletion
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete the {{ store.selectedItem?.type.charAt(0).toUpperCase()
                                    + store.selectedItem?.type.slice(1) }} "{{ store.selectedItem?.name }}"?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <span class="flex w-full rounded-md shadow-sm sm:col-start-2">
                        <button @click="confirmDelete" :disabled="isLoading"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                            <span v-if="isLoading">Deleting...</span>
                            <span v-else>Delete</span>
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:col-start-1">
                        <button @click="cancelDelete" :disabled="isLoading"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                            Cancel
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, computed, ref } from 'vue';
import { useFilemanagerStore } from '../store';
import axios from 'axios';

export default defineComponent({
    name: 'DeleteSelectedButton',
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
