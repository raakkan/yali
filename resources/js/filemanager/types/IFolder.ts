import { IFile } from './IFile';

export interface IFolder {
    name: string;
    path: string;
    fullPath: string;
    folders: IFolder[];
    files: IFile[];
    parent: IFolder | null;
}

export interface SelectedFolder extends IFolder {
    type: 'folder';
}