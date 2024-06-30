<template>
    <nav class="flex p-4 bg-gray-100 dark:bg-gray-800 border-b dark:border-gray-600" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li v-for="(folder, index) in store.breadcrumbs" :key="folder.path" class="inline-flex items-center">
                <span v-if="index > 0" class="mr-2">/</span>
                <a href="#" @click.prevent="store.openFolder(folder)"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg v-if="index === 0" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                    {{ folder.name }}
                </a>
            </li>
        </ol>
    </nav>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { useFilemanagerStore } from '../store';

export default defineComponent({
    name: 'Breadcrumbs',
    setup() {
        const store = useFilemanagerStore();

        return {
            store,
        };
    }
});
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
