export interface IFile {
    name: string;
    path: string;
    fullPath: string;
    url: string;
    size: string;
    mime_type: string;
    extension: string;
    last_modified: string;
    thumbnails?: {
        thumb: {
            path: string;
            url: string;
        };
        small_thumb: {
            path: string;
            url: string;
        };
        very_small_thumb: {
            path: string;
            url: string;
        };
    };
}

export interface SelectedFile extends IFile {
    type: 'file';
}
