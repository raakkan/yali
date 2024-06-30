<template>
    <div>
        <div v-if="isLoading" class="text-center py-4">
            Loading...
        </div>
        <div v-else-if="!hasContent" class="text-center py-4">
            No files or folders found in this directory.
        </div>
        <div v-else class="flex flex-row space-x-4">
            <FolderComponent v-for="folder in folders" :key="folder.path" :folder="folder" />
            <FileComponent v-for="file in files" :key="file.path" :file="file" />
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import FolderComponent from './FolderComponent.vue';
import FileComponent from './FileComponent.vue';

const props = defineProps({
    isLoading: Boolean,
    folders: Array,
    files: Array
});

const hasContent = computed(() =>
    (props.folders && props.folders.length > 0) ||
    (props.files && props.files.length > 0)
);
</script>