<template>
  <div class="container mx-auto p-6">
    <ul>
      <li v-for="folder in folders" :key="folder.path">
        {{ folder.fullPath }}
      </li>
    </ul>
    <ul>
      <li v-for="file in folders.files" :key="file.path">{{ file.name }}</li>
    </ul>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { useFilemanagerStore } from './store';
import { storeToRefs } from 'pinia';

export default defineComponent({
  name: 'FileManagerComponent',
  props: {
    dataProp: {
      type: Object,
      required: true
    }
  },
  setup() {
    const store = useFilemanagerStore();
    const { folders } = storeToRefs(store);

    store.fetchFiles();

    return { folders };
  }
});
</script>
