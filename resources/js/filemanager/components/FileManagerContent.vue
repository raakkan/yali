<template>
    <div class="p-4">
        <div v-if="!hasContent && !isLoading" class="text-center py-4">
            No files or folders found in this directory.
        </div>
        <div v-else class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
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