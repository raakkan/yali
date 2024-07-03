<template>
    <div @click="selectFolder" @dblclick="openFolder" :class="['flex flex-col items-center w-16 md:w-20 p-2 rounded-lg transition-colors cursor-pointer',
        isSelected ? 'bg-blue-100' : 'hover:bg-gray-100']">
        <svg class="w-12 h-12 md:w-16 md:h-16 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            fill="currentColor">
            <path
                d="M12.4142 5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H10.4142L12.4142 5Z">
            </path>
        </svg>
        <span class="mt-2 text-sm font-medium text-gray-700 text-center break-all  line-clamp-2">{{ folder.name
            }}</span>
    </div>
</template>

<script lang="ts">
import { defineComponent, computed } from 'vue';
import { useFilemanagerStore } from '../store/FileManagerStore';
import { IFolder } from '../types';

// TODO: test double click in mobile

export default defineComponent({
    name: 'FolderComponent',
    props: {
        folder: {
            type: Object as () => IFolder,
            required: true
        }
    },
    setup(props) {
        const store = useFilemanagerStore();

        const isSelected = computed(() => {
            return store.selectedItem?.path === props.folder.path && store.selectedItem?.type === 'folder';
        });

        const selectFolder = () => {
            store.selectItem({ ...props.folder, type: 'folder' });
        };

        const openFolder = () => {
            store.openFolder(props.folder);
        };

        return { isSelected, selectFolder, openFolder };
    }
});
</script>