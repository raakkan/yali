<template>
    <div class="">
      File Manager
      <div>{{ files }}</div>
      <div>{{ dataProp }}</div>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent } from 'vue';
  import axios from 'axios';
  
  export default defineComponent({
    name: 'FileManagerComponent',
    data() {
      return {
        files: [],
      };
    },
    props: {
      dataProp: {
        type: Object,
        required: true
      }
    },
    created() {
      this.fetchFiles();
    },
    methods: {
      async fetchFiles() {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/admin/file-manager');
          this.files = response.data;
        } catch (error) {
          console.error('Failed to fetch files:', error);
        }
      }
    }
  });
  </script>
  
  <style scoped>
  </style>
  