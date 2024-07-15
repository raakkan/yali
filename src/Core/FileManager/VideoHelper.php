<?php

namespace Raakkan\Yali\Core\FileManager;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Illuminate\Contracts\Filesystem\Filesystem;
use Raakkan\Yali\Core\Support\Facades\YaliLog;

class VideoHelper
{
    private Filesystem $storage;

    private ImageHelper $imageHelper;

    public function __construct(Filesystem $storage)
    {
        $this->storage = $storage;
        $this->imageHelper = new ImageHelper($storage);
    }

    public function processVideo($videoPath, ?string $folder = null, ?string $path = null): ?string
    {
        $ffmpegBinary = '';
        $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

        if ($isWindows) {
            $ffmpegBinary = 'C:\FFmpeg\bin\ffmpeg.exe';

            if (! file_exists($ffmpegBinary) || ! is_executable($ffmpegBinary)) {
                YaliLog::info('FFmpeg not installed or not accessible');

                return null;
            }
        } else {
            $ffmpegBinary = trim(exec('which ffmpeg', $output, $status));
            if ($status !== 0) {
                YaliLog::info('FFmpeg not installed or not accessible');

                return null;
            }
        }

        $folder = $folder ? ltrim($folder, DIRECTORY_SEPARATOR) : null;

        $filename = $this->removeFileExtension(basename($path));

        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => $ffmpegBinary,
        ]);
        $video = $ffmpeg->open($videoPath);

        $frame = $video->frame(TimeCode::fromSeconds(3));

        $thumbnailPath = $folder ? $folder.DIRECTORY_SEPARATOR.$filename.'.jpg' : $filename.'.jpg';
        $frame->save($this->storage->path($thumbnailPath));

        $thumb = $this->storage->get($thumbnailPath);

        $this->imageHelper->generateThumbnails($thumb, basename($thumbnailPath), $folder, 'videos');

        $this->storage->delete($thumbnailPath);

        return $thumbnailPath;
    }

    private function removeFileExtension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_FILENAME);
    }
}
