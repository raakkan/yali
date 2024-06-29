import { IFile } from './IFile';

export interface IFolder {
    name: string;
    path: string;
    fullPath: string;
    folders: IFolder[];
    files: IFile[];
}