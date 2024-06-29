import { defineStore } from 'pinia';
import axios from 'axios';
import { IFolder } from '../types';

export const useFilemanagerStore = defineStore('filemanager', {
    state: () => {
        return {
            rootFolder: null as IFolder | null,
            currentFolder: null as IFolder | null,
            folders: [] as IFolder[],
            isLoading: false as boolean,
            error: null as string | null,
        };
    },
    actions: {
        async fetchFiles() {
            const response = await axios.get('http://127.0.0.1:8000/api/admin/file-manager');
            this.folders = response.data.folders;
            console.log(this.folders);

            this.folders.files = response.data.files;
        },
    },
});