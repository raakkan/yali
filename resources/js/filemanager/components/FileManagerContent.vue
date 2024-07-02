<template>
    <div class="p-4">
        <div v-if="isLoading && !isLoaded">
            <div class="grid grid-cols-auto-fill gap-2 md:gap-1">
                <FolderComponentSkeleton v-for="n in 3" :key="n" />
                <FileComponentSkeleton v-for="n in 3" :key="n" />
            </div>
        </div>
        <div v-if="!hasContent && !isLoading" class="text-center py-4">
            No files or folders found in this directory.
        </div>
        <div v-else class="grid grid-cols-auto-fill gap-2 md:gap-1">
            <FolderComponent v-for="folder in folders" :key="folder.path" :folder="folder" />
            <FileComponent v-for="file in files" :key="file.path" :file="file" :select="select" />
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import FolderComponent from './FolderComponent.vue';
import FileComponent from './FileComponent.vue';
import FolderComponentSkeleton from './Skeletons/FolderComponentSkeleton.vue';
import FileComponentSkeleton from './Skeletons/FileComponentSkeleton.vue';

const props = defineProps({
    isLoading: Boolean,
    isLoaded: Boolean,
    folders: Array,
    files: Array,
    select: Boolean
});

const hasContent = computed(() =>
    (props.folders && props.folders.length > 0) ||
    (props.files && props.files.length > 0)
);
</script>
<style scoped>
.grid-cols-auto-fill {
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
}
@media (max-width: 639px) {
    .grid-cols-auto-fill {
        grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
    }
}
</style>