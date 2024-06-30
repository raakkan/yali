<?php

namespace Raakkan\Yali\Core\FileManager;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class FileManager
{
    private const DEFAULT_DISK = 'local';

    private Filesystem $storage;

    public function __construct(Filesystem $storage)
    {
        $this->storage = $storage;
    }

    public function createFolder(string $name, ?string $parent = null): void
    {
        $path = $parent ? "{$parent}/{$name}" : $name;
        if ($this->storage->exists($path)) {
            throw new \Exception("Folder already exists.");
        }
        $this->storage->makeDirectory($path);
    }

    public function uploadFile($file, ?string $folder = null): string
    {
        $path = $folder ? $folder . '/' . $file->getClientOriginalName() : $file->getClientOriginalName();
        $this->storage->putFileAs($folder, $file, $file->getClientOriginalName());
        return $path;
    }

    public function delete(string $type, string $path): void
    {
        if ($type === 'file') {
            if (!$this->storage->exists($path)) {
                throw new \Exception("File does not exist.");
            }
            $this->storage->delete($path);
        } elseif ($type === 'folder') {
            if (!$this->storage->exists($path)) {
                throw new \Exception("Folder does not exist.");
            }
            $this->storage->deleteDirectory($path);
        } else {
            throw new \Exception("Invalid type specified.");
        }
    }

    public function getFolderContents(?string $folder = null, string $disk = self::DEFAULT_DISK): array
    {
        $files = $this->getFiles($folder, $disk);
        $folders = $this->getAllFolders($folder);
        return [
            'files' => $files->toArray(),
            'folders' => $folders->toArray(),
        ];
    }

    public function getAllFolders(?string $folder = null): Collection
    {
        $folders = $folder ? $this->storage->directories($folder) : $this->storage->directories();
        return collect($folders)->map(function ($folderPath) {
            return [
                'name' => basename($folderPath),
                'path' => $folderPath,
                'fullPath' => $this->storage->path($folderPath),
            ];
        })->values();
    }

    public function getFiles(?string $folder = null, string $disk = self::DEFAULT_DISK): Collection
    {
        $files = $folder ? $this->storage->files($folder) : $this->storage->files();
        
        return collect($files)->map(function ($file) use ($folder) {
            $path = $folder ? "{$folder}/{$file}" : $file;
            return $this->getFileInfo($file);
        })->values();
    }
    
    private function getFileInfo(string $path): array
    {
        return [
            'name' => basename($path),
            'path' => $path,
            'fullPath' => $this->storage->path($path),
            'url' => $this->storage->url($path),
            'size' => $this->formatFileSize($this->storage->size($path)),
            'mime_type' => $this->storage->mimeType($path),
            'extension' => pathinfo($path, PATHINFO_EXTENSION),
            'last_modified' => $this->formatDate($this->storage->lastModified($path)),
        ];
    }
    
    private function formatFileSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, 2) . ' ' . $units[$pow];
    }
    
    private function formatDate(int $timestamp): string
    {
        return Carbon::createFromTimestamp($timestamp)->format('Y-m-d H:i:s');
    }
}