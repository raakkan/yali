<?php

namespace Raakkan\Yali\Core\FileManager;

use Intervention\Image\ImageManager;
use Illuminate\Contracts\Filesystem\Filesystem;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;

class ImageHelper
{
    private ImageManager | bool $imageManager;
    private Filesystem $storage;

    public function __construct(Filesystem $storage)
    {
        $this->imageManager = $this->createImageManager();
        $this->storage = $storage;
    }

    public function processImage($file, ?string $folder = null, ?string $path = null): array
    {
        if (!$this->imageManager) {
            return [
                'driver' => 'Driver not available',
            ];
        }

        $thumbnails = $this->generateThumbnails($file, basename($path), $folder);
        $webpPath = $this->generateWebp($file, basename($path), $folder);

        return [
            'original' => $path,
            'webp' => $webpPath,
            'thumbnails' => $thumbnails,
            'imageDetails' => $this->getImageDetails($file),
        ];
    }

    public function getImageDetails($file): array
    {
        if (!$this->imageManager) {
            return [];
        }

        $image = $this->imageManager->read($file);
        return [
            'width' => $image->width(),
            'height' => $image->height(),
            'mime' => $file->getMimeType(), // Use the original file's mime type
            'extension' => $file->getClientOriginalExtension(), // Use the original file's extension
        ];
    }

    public function generateThumbnails($file, string $filename, string $folder = null, string $thumbnailFolder = 'images'): array
    {
        $filename = $this->removeFileExtension($filename);
        $image = $this->imageManager->read($file);

        $thumbnails = [
            'thumb' => [
                'width' => 300,
                'quality' => 80,
                'path' => '',
            ],
            'small_thumb' => [
                'width' => 150,
                'quality' => 70,
                'path' => '',
            ],
            'very_small_thumb' => [
                'width' => 50,
                'quality' => 60,
                'path' => '',
            ],
        ];

        foreach ($thumbnails as $key => &$thumbnail) {
            $thumbImage = $image->scale(width: $thumbnail['width'])
                ->toWebp(quality: $thumbnail['quality']);
            
            $thumbFolder = 'thumbnails' . DIRECTORY_SEPARATOR . $thumbnailFolder . DIRECTORY_SEPARATOR . $folder;
            $thumbPath = $folder ? $thumbFolder . DIRECTORY_SEPARATOR . $filename . "_{$key}.webp" : 'thumbnails' . DIRECTORY_SEPARATOR . $thumbnailFolder . DIRECTORY_SEPARATOR . $filename . "_{$key}.webp";
            
            $this->storage->put($thumbPath, $thumbImage);
            $thumbnail['path'] = $thumbPath;
        }

        return $thumbnails;
    }

    public function generateWebp($file, string $filename, string $folder = null): string
    {
        $filename = $this->removeFileExtension($filename);
        $webpPath = $folder ? 'webp' . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $filename . '.webp' : 'webp' . DIRECTORY_SEPARATOR . $filename . '.webp';
        $image = $this->imageManager->read($file);
        $webpImage = $image->toWebp(quality: 100);
        $this->storage->put($webpPath, $webpImage);
        return $webpPath;
    }

    public function getThumbnails(string $filename, ?string $folder = null, string $thumbnailFolder = 'images'): array
    {
        $filename = $this->removeFileExtension($filename);
        $folder = $folder ? ltrim($folder, DIRECTORY_SEPARATOR) : null;
        $thumbnails = [
            'thumb' => [
                'path' => $folder ? 'thumbnails' . DIRECTORY_SEPARATOR . $thumbnailFolder . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . "{$filename}_thumb.webp" : 'thumbnails' . DIRECTORY_SEPARATOR . $thumbnailFolder . DIRECTORY_SEPARATOR . "{$filename}_thumb.webp",
                'url' => null,
            ],
            'small_thumb' => [
                'path' => $folder ? 'thumbnails' . DIRECTORY_SEPARATOR . $thumbnailFolder . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . "{$filename}_small_thumb.webp" : 'thumbnails' . DIRECTORY_SEPARATOR . $thumbnailFolder . DIRECTORY_SEPARATOR . "{$filename}_small_thumb.webp",
                'url' => null,
            ],
            'very_small_thumb' => [
                'path' => $folder ? 'thumbnails' . DIRECTORY_SEPARATOR . $thumbnailFolder . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . "{$filename}_very_small_thumb.webp" : 'thumbnails' . DIRECTORY_SEPARATOR . $thumbnailFolder . DIRECTORY_SEPARATOR . "{$filename}_very_small_thumb.webp",
                'url' => null,
            ],
        ];

        foreach ($thumbnails as $key => $thumbnail) {
            $path = $thumbnail['path'];
            // if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            //     $path = str_replace('\\', '/', $path);
            // }
            if ($this->storage->exists($path)) {
                $thumbnails[$key]['url'] = $this->storage->url($path);
            }
        }

        return $thumbnails;
    }

    private function createImageManager(): ImageManager | bool
    {
        if (extension_loaded('imagick')) {
            return new ImageManager(new ImagickDriver());
        } elseif (extension_loaded('gd')) {
            return new ImageManager(new GdDriver());
        }
        return false;
    }

    private function removeFileExtension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_FILENAME);
    }
}
