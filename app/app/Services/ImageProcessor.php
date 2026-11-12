<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class ImageProcessor
{
    /** Writes the large and medium JPEG versions of a painting to the public disk. */
    public function store(string $sourcePath, int $id): void
    {
        $this->resize($sourcePath, 'pics/'.$id.'_l.jpg', 1920, 90);
        $this->resize($sourcePath, 'pics/'.$id.'_m.jpg', 600, 80);
    }

    public function delete(int $id): void
    {
        Storage::disk('public')->delete(['pics/'.$id.'_l.jpg', 'pics/'.$id.'_m.jpg']);
    }

    // The shortest side is scaled to $size, like the legacy uploader did.
    private function resize(string $sourcePath, string $target, int $size, int $quality): void
    {
        $info = getimagesize($sourcePath);
        $source = match ($info[2] ?? null) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($sourcePath),
            IMAGETYPE_PNG => imagecreatefrompng($sourcePath),
            IMAGETYPE_WEBP => imagecreatefromwebp($sourcePath),
            default => throw new InvalidArgumentException('Unsupported image type.'),
        };

        [$width, $height] = $info;
        $scale = $size / min($width, $height);
        $newWidth = (int) round($width * $scale);
        $newHeight = (int) round($height * $scale);

        $canvas = imagecreatetruecolor($newWidth, $newHeight);
        imagefill($canvas, 0, 0, imagecolorallocate($canvas, 255, 255, 255));
        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $path = Storage::disk('public')->path($target);
        if (! is_dir(dirname($path))) {
            mkdir(dirname($path), 0775, true);
        }
        imagejpeg($canvas, $path, $quality);
    }
}
