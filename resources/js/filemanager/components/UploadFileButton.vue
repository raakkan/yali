<template>
    <label class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded cursor-pointer">
        Upload File
        <input type="file" class="hidden" @change="uploadFile" />
    </label>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { useFilemanagerStore } from '../store';

export default defineComponent({
    name: 'UploadFileButton',
    setup() {
        const store = useFilemanagerStore();

        const uploadFile = (event: Event) => {
            const file = (event.target as HTMLInputElement).files?.[0];
            if (file) {
                store.uploadFile(file);
            }
        };

        return {
            uploadFile
        };
    }
});
</script>