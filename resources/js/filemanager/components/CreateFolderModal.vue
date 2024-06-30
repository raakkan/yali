<template>
    <div v-if="show" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Create New Folder</h3>
            <input v-model="folderName" type="text" placeholder="Folder Name" class="w-full p-2 border rounded mb-4">
            <div class="flex justify-end space-x-2">
                <button @click="cancel" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
                <button @click="create" class="px-4 py-2 bg-blue-500 text-white rounded">Create</button>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, watch } from 'vue';

export default defineComponent({
    name: 'CreateFolderModal',
    props: {
        show: {
            type: Boolean,
            required: true
        }
    },
    emits: ['close', 'create'],
    setup(props, { emit }) {
        const folderName = ref('');

        const cancel = () => {
            folderName.value = '';
            emit('close');
        };

        const create = () => {
            if (folderName.value.trim()) {
                emit('create', folderName.value.trim());
                folderName.value = '';
            }
        };

        watch(() => props.show, (newValue) => {
            if (!newValue) {
                folderName.value = '';
            }
        });

        return {
            folderName,
            cancel,
            create
        };
    }
});
</script>