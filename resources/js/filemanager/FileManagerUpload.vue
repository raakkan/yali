<template>
    <div v-if="isModalOpen"
        class="fixed inset-0 z-50 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full p-2 md:p-0 md:flex md:items-center md:justify-center">
        <div class=" w-full max-w-4xl">
            <FileManagerComponent :data-props="{ root: { name: 'root', path: '/' } }" :select="true" />
            <div class="bg-white flex flex-row items-center justify-between p-3 md:p-6 rounded-b-lg">

                <SelectedFiles />

                <div class="flex flex-col space-y-3">
                    <button @click="closeModal" class="btn btn-primary btn-xs md:btn-sm">
                        Cancel
                    </button>
                    <button class="btn btn-primary btn-xs md:btn-sm">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed, onMounted, onUnmounted } from 'vue';
import { useFilemanagerStore } from './store/FileManagerStore';
import { useFileSelectStore } from './store/FileSelectStore';
import FileManagerComponent from './FileManagerComponent.vue';
import SelectedFiles from './components/select/SelectedFiles.vue';

export default defineComponent({
    name: 'FileManagerUpload',
    components: {
        FileManagerComponent,
        SelectedFiles
    },
    setup() {
        const store = useFilemanagerStore();
        const fileSelectStore = useFileSelectStore();
        const isModalOpen = ref(false);

        onMounted(() => {
            window.addEventListener('open-file-upload-modal', (event) => openModal(event));
        });

        onUnmounted(() => {
            window.removeEventListener('open-file-upload-modal', (event) => openModal(event));
        });

        const openModal = (event) => {
            const eventData = event.detail;

            if (eventData.hasOwnProperty('accept')) {
                fileSelectStore.setFileTypeFilter(eventData.accept);
            }
            if (eventData.hasOwnProperty('multiple')) {
                eventData.multiple ? fileSelectStore.setMultiSelect() : fileSelectStore.setSingleSelect();
            }

            isModalOpen.value = true;
        };

        const closeModal = () => {
            isModalOpen.value = false;
            store.resetStore();
            fileSelectStore.resetStore();
        };

        return {
            store,
            isModalOpen,
            openModal,
            closeModal,
            fileSelectStore
        };
    },
});
</script>