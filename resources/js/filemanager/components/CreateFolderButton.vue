<template>
    <div>
        <button @click="showModal" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            New Folder
        </button>
        <CreateFolderModal :show="showCreateFolderModal" @close="closeModal" @create="createFolder" />
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { useFilemanagerStore } from '../store';
import CreateFolderModal from './CreateFolderModal.vue';

export default defineComponent({
    name: 'CreateFolderButton',
    components: {
        CreateFolderModal
    },
    setup() {
        const store = useFilemanagerStore();
        const showCreateFolderModal = ref(false);

        const showModal = () => {
            showCreateFolderModal.value = true;
        };

        const closeModal = () => {
            showCreateFolderModal.value = false;
        };

        const createFolder = (folderName: string) => {
            store.createFolder(folderName);
            closeModal();
        };

        return {
            showCreateFolderModal,
            showModal,
            closeModal,
            createFolder
        };
    }
});
</script>