<template>
  <div class="bg-white dark:bg-gray-800 border dark:border-gray-600" :class="select ? 'rounded-t-lg' : 'rounded-lg'">
    <div class="p-4 flex flex-col md:flex-row md:justify-between md:items-center border-b dark:border-gray-600">
      <h2 class="text-2xl font-semibold" :class="select ? 'hidden md:block' : ''">File Manager</h2>
      <div class="flex justify-between md:justify-start md:space-x-2" :class="select ? 'mt-0' : 'mt-4 md:mt-0'">
        <RefreshButton />
        <CreateFolderButton />
        <UploadFileButton />
        <DeleteSelectedButton v-if="!select" />
      </div>
    </div>

    <div class="h-full" :class="select ? 'max-h-80 overflow-y-auto' : ''">

      <div v-if="store.isLoading && !isLoaded">
        <BreadcrumbsSkeleton />
      </div>

      <Breadcrumbs />

      <FileManagerContent :isLoading="store.isLoading" :isLoaded="isLoaded" :folders="store.currentFolder?.folders"
        :files="store.currentFolder?.files" :select="select" />
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
import RefreshButton from './components/RefreshButton.vue';
import { IFolder, IFile } from './types';
import BreadcrumbsSkeleton from './components/Skeletons/BreadcrumbsSkeleton.vue';

export default defineComponent({
  name: 'FileManagerComponent',
  components: {
    FileManagerContent,
    Breadcrumbs,
    CreateFolderButton,
    UploadFileButton,
    DeleteSelectedButton,
    RefreshButton,
    BreadcrumbsSkeleton
  },
  props: {
    dataProps: {
      type: Object,
      required: true
    },
    select: {
      type: Boolean,
      default: false
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

    const isLoaded = computed(() => {
      return store.currentFolder !== null;
    });

    return {
      store,
      isLoading,
      error,
      isLoaded,
    };
  }
});
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
