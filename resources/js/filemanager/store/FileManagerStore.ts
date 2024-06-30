import { defineStore } from 'pinia';
import axios from 'axios';
import { IFolder, IFile, SelectedFolder, SelectedFile } from '../types';

export type SelectedItem = SelectedFolder | SelectedFile;

export const useFilemanagerStore = defineStore('filemanager', {
    state: () => ({
        rootFolder: null as IFolder | null,
        currentFolder: null as IFolder | null,
        selectedItem: null as SelectedItem | null,
        isLoading: false,
        error: null as string | null,
    }),

    actions: {
        setRootFolder(folder: IFolder) {
            this.rootFolder = { ...folder, parent: null };
        },
        async fetchRootContents() {
            if (this.rootFolder) {
                await this.openFolder(this.rootFolder);
            } else {
                console.error('Root folder not set');
            }
        },

        async openFolder(folder: IFolder) {
            this.isLoading = true;
            const path = folder ? folder.path : '/';

            try {
                const response = await axios.get(`http://127.0.0.1:8000/api/admin/file-manager?folder=${path}`);

                if (response.data.folders.length || response.data.files.length) {
                    folder.files = response.data.files;
                    folder.folders = response.data.folders.map((subfolder: IFolder) => ({
                        ...subfolder,
                        parent: folder
                    }));
                } else {
                    folder.files = [];
                    folder.folders = [];
                }

                this.currentFolder = folder;
                this.clearSelection();
                this.error = null;
            } catch (error) {
                this.error = 'Failed to open folder';
                console.error('Error opening folder:', error);
            } finally {
                this.isLoading = false;
            }
        },

        async refresh() {
            if (this.currentFolder) {
                await this.openFolder(this.currentFolder);
            } else if (this.rootFolder) {
                await this.fetchRootContents();
            } else {
                console.error('No folder to refresh');
            }
        },

        selectItem(item: SelectedItem) {
            this.selectedItem = item;
        },

        clearSelection() {
            this.selectedItem = null;
        },

        async uploadFile(file: File) {
            console.log(file, this.currentFolder);

            // this.isLoading = true;
            // try {
            //     const formData = new FormData();
            //     formData.append('file', file);
            //     if (this.currentFolder) {
            //         formData.append('folder', this.currentFolder.path);
            //     }
            //     await axios.post('http://127.0.0.1:8000/api/admin/file-manager/upload', formData, {
            //         headers: { 'Content-Type': 'multipart/form-data' }
            //     });
            //     await this.openFolder(this.currentFolder);
            // } catch (error) {
            //     this.error = 'Failed to upload file';
            //     console.error('Error uploading file:', error);
            // } finally {
            //     this.isLoading = false;
            // }
        },
    },

    getters: {
        hasSelection: (state) => state.selectedItem !== null,
        currentPath: (state) => state.currentFolder ? state.currentFolder.path : '',
        breadcrumbs: (state) => {
            const breadcrumbs: IFolder[] = [];
            if (state.rootFolder && state.currentFolder) {
                let current: IFolder | null = state.currentFolder;
                while (current && current.path !== state.rootFolder.path) {
                    breadcrumbs.unshift(current);
                    current = current.parent as IFolder | null;
                }
                breadcrumbs.unshift(state.rootFolder);
            }
            return breadcrumbs;
        }
    },
});
