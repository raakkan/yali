<template>
    <div v-if="isModalOpen"
        class="fixed inset-0 z-50 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full p-2 md:p-0 md:flex md:items-center md:justify-center">
        <div>
            <FileManagerComponent :data-props="{ root: { name: 'root', path: '/' } }" :select="true" />
            <div class="bg-white flex items-center justify-between p-4">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Selected Files
                    </h3>
                </div>
                <div class="flex justify-end space-x-2">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Save
                    </button>
                    <button @click="closeModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed, onMounted, onUnmounted } from 'vue';
import { useFilemanagerStore } from './store/FileManagerStore';
import FileManagerComponent from './FileManagerComponent.vue';

export default defineComponent({
    name: 'FileManagerUpload',
    components: {
        FileManagerComponent
    },
    setup() {
        const store = useFilemanagerStore();
        const isModalOpen = ref(false);

        onMounted(() => {
            window.addEventListener('open-file-upload-modal', openModal);
        });

        onUnmounted(() => {
            window.removeEventListener('open-file-upload-modal', openModal);
        });

        const openModal = () => {
            isModalOpen.value = true;
        };

        const closeModal = () => {
            isModalOpen.value = false;
            store.resetStore();
        };

        return {
            store,
            isModalOpen,
            openModal,
            closeModal
        };
    },
});
</script>