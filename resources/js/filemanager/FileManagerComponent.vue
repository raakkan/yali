<template>
  <div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="mb-4 flex justify-between items-center">
      <h2 class="text-2xl font-bold text-gray-800">File Manager</h2>
      <div class="flex space-x-2">
        <CreateFolderButton />
        <UploadFileButton />
        <DeleteSelectedButton />
      </div>
    </div>

    <Breadcrumbs />

    <FileManagerContent :isLoading="store.isLoading" :folders="store.currentFolder?.folders"
      :files="store.currentFolder?.files" />

    <div v-if="store.error" class="fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg">
      {{ store.error }}
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed } from 'vue';
import { useFilemanagerStore } from './store/FileManagerStore';
import { storeToRefs } from 'pinia';
import Breadcrumbs from './components/Breadcrumbs.vue';
import FileManagerContent from './components/FileManagerContent.vue';
import CreateFolderButton from './components/CreateFolderButton.vue';
import UploadFileButton from './components/UploadFileButton.vue';
import DeleteSelectedButton from './components/DeleteSelectedButton.vue';
import { IFolder, IFile } from './types';

export default defineComponent({
  name: 'FileManagerComponent',
  components: {
    FileManagerContent,
    Breadcrumbs,
    CreateFolderButton,
    UploadFileButton,
    DeleteSelectedButton
  },
  props: {
    dataProps: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const data = props.dataProps;
    const store = useFilemanagerStore();
    const { isLoading, error } = storeToRefs(store);

    const rootFolder: IFolder = {
      name: data.root.name,
      path: data.root.path,
      fullPath: data.root.fullPath || data.root.path,
      files: [],
      folders: [],
      parent: null
    };

    store.setRootFolder(rootFolder);

    store.fetchRootContents();

    return {
      store,
      isLoading,
      error
    };
  }
});
</script>

<style scoped>
/* Add any component-specific styles here */
</style>