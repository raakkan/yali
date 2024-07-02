import { defineStore } from 'pinia';
import { IFile } from '../types';

type FileType = 'all' | 'image' | 'zip' | 'pdf' | 'doc' | 'xls' | 'txt' | 'video' | 'audio';

export const useFileSelectStore = defineStore('fileSelect', {
    state: () => ({
        selectedFiles: [] as IFile[],
        multiSelect: true,
        fileTypeFilter: 'all' as FileType,
    }),

    actions: {
        setSingleSelect() {
            this.multiSelect = false;
            this.clearSelectedFiles();
        },
        setMultiSelect() {
            this.multiSelect = true;
        },
        setFileTypeFilter(fileType: FileType) {
            this.fileTypeFilter = fileType;
        },
        selectFile(file: IFile) {
            if (this.canSelectFile(file)) {
                if (this.multiSelect) {
                    if (!this.isFileSelected(file)) {
                        this.selectedFiles.push(file);
                    }
                } else {
                    this.clearSelectedFiles();
                    this.selectedFiles.push(file);
                }
            }
        },
        deselectFile(file: IFile) {
            this.selectedFiles = this.selectedFiles.filter(f => f.path !== file.path);
        },
        clearSelectedFiles() {
            this.selectedFiles = [];
        },
        resetStore() {
            this.$reset();
        },
    },

    getters: {
        isFileSelected: (state) => {
            return (file: IFile) => state.selectedFiles.some(f => f.path === file.path);
        },
        isSingleSelect: (state) => {
            return !state.multiSelect;
        },
        isMultiSelect: (state) => {
            return state.multiSelect;
        },
        canSelectFile: (state) => {
            return (file: IFile) => {
                if (state.fileTypeFilter === 'all') {
                    return true;
                } else if (state.fileTypeFilter === 'image') {
                    // check other image types like eps
                    return file.mime_type.startsWith('image/');
                } else if (state.fileTypeFilter === 'zip') {
                    return file.extension === 'zip';
                } else if (state.fileTypeFilter === 'pdf') {
                    return file.extension === 'pdf';
                } else if (state.fileTypeFilter === 'doc') {
                    return file.extension === 'doc' || file.extension === 'docx';
                } else if (state.fileTypeFilter === 'xls') {
                    return file.extension === 'xls' || file.extension === 'xlsx';
                } else if (state.fileTypeFilter === 'txt') {
                    return file.extension === 'txt';
                } else if (state.fileTypeFilter === 'video') {
                    return file.mime_type.startsWith('video/');
                } else if (state.fileTypeFilter === 'audio') {
                    return file.mime_type.startsWith('audio/');
                }
                return false;
            };
        },
    },
});
