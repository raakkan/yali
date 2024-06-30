// FileTreeManager.ts

import { IFolder, IFile } from '../types';

interface TreeNode {
    type: 'folder' | 'file';
    name: string;
    path: string;
    children?: Record<string, TreeNode>;
    content?: IFolder | IFile;
}

export class FileTreeManager {
    private fileTree: Record<string, TreeNode> = {};

    updateFileTree(parentPath: string, folders: IFolder[], files: IFile[]) {
        const parentNode = this.getOrCreateNode(parentPath);
        parentNode.children = {};

        [...folders, ...files].forEach(item => {
            const isFolder = 'type' in item && item.type === 'folder';
            parentNode.children![item.name] = {
                type: isFolder ? 'folder' : 'file',
                name: item.name,
                path: item.path,
                content: item,
                ...(isFolder ? { children: {} } : {}),
            };
        });
    }

    getOrCreateNode(path: string): TreeNode {
        const parts = path.split('/').filter(Boolean);
        let node: TreeNode = { type: 'folder', name: '', path: '', children: this.fileTree };

        for (const part of parts) {
            if (!node.children || !node.children[part]) {
                node.children = node.children || {};
                node.children[part] = { type: 'folder', name: part, path: `${node.path}/${part}`, children: {} };
            }
            node = node.children[part];
        }

        return node;
    }

    getNodeByPath(path: string): TreeNode | null {
        const parts = path.split('/').filter(Boolean);
        let node: TreeNode | null = { type: 'folder', name: '', path: '', children: this.fileTree };

        for (const part of parts) {
            if (node && node.children && node.children[part]) {
                node = node.children[part];
            } else {
                return null;
            }
        }

        return node;
    }
}
