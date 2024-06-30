<template>
    <div>
        <button @click="showConfirmDialog"
            :class="['flex items-center px-4 py-2 rounded text-white transition-colors', hasSelection ? 'bg-red-500 hover:bg-red-600' : 'bg-gray-500 cursor-not-allowed']"
            :disabled="!hasSelection">
            <span>Delete</span>
        </button>

        <!-- Custom Confirmation Dialog -->
        <div v-if="isConfirmDialogVisible"
            class="fixed inset-0 z-50 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
            <div class="bg-white p-5 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Confirm Deletion</h2>
                <p class="mb-4">Are you sure you want to delete the selected item(s)?</p>
                <div class="flex justify-end">
                    <button @click="cancelDelete"
                        class="mr-2 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</button>
                    <button @click="confirmDelete"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, computed, ref } from 'vue';
import { useFilemanagerStore } from '../store';

export default defineComponent({
    name: 'DeleteSelectedButton',
    setup() {
        const store = useFilemanagerStore();
        const isConfirmDialogVisible = ref(false);

        const hasSelection = computed(() => store.hasSelection);

        const showConfirmDialog = () => {
            isConfirmDialogVisible.value = true;
        };

        const cancelDelete = () => {
            isConfirmDialogVisible.value = false;
        };

        const confirmDelete = () => {
            store.deleteSelected();
            isConfirmDialogVisible.value = false;
        };

        return {
            hasSelection,
            isConfirmDialogVisible,
            showConfirmDialog,
            cancelDelete,
            confirmDelete
        };
    }
});
</script>
