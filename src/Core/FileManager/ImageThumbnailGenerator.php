<?php

namespace Raakkan\Yali\Core\FileManager;

use Intervention\Image\ImageManager;
use Illuminate\Contracts\Filesystem\Filesystem;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;

class ImageThumbnailGenerator
{
    private ImageManager | bool $imageManager;
    private Filesystem $storage;

    public function __construct(Filesystem $storage)
    {
        $this->imageManager = $this->createImageManager();
        $this->storage = $storage;
    }

    public function generateThumbnail($file, string $filename, string $folder = null): void
    {
        $filename = $this->removeFileExtension($filename);

        $image = $this->imageManager->read($file);

        $webpImage = $image->toWebp(quality: 100);

        $thumbnail = $image->scale(width: 300)
            ->toWebp(quality: 80);

        $smallThumbnail = $image->scale(width: 150)
            ->toWebp(quality: 70);

        $verySmallThumbnail = $image->scale(width: 50)
            ->toWebp(quality: 60);
        

        $webpPath = $folder ? "webp/{$folder}/{$filename}.webp" : "webp/{$filename}.webp";
        $thumbnailPath = $folder ? "thumbnails/{$folder}/{$filename}_thumb.webp" : "thumbnails/{$filename}_thumb.webp";
        $smallThumbnailPath = $folder ? "thumbnails/{$folder}/{$filename}_small_thumb.webp" : "thumbnails/{$filename}_small_thumb.webp";
        $verySmallThumbnailPath = $folder ? "thumbnails/{$folder}/{$filename}_very_small_thumb.webp" : "thumbnails/{$filename}_very_small_thumb.webp";

        $this->storage->put($webpPath, $webpImage);
        $this->storage->put($thumbnailPath, $thumbnail);
        $this->storage->put($smallThumbnailPath, $smallThumbnail);
        $this->storage->put($verySmallThumbnailPath, $verySmallThumbnail);
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
