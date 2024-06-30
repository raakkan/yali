export interface IFile {
    name: string;
    path: string;
    fullPath: string;
    url: string;
    size: string;
    mime_type: string;
    extension: string;
    last_modified: string;
}

export interface SelectedFile extends IFile {
    type: 'file';
}