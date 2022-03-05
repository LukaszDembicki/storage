<?php
declare(strict_types=1);

namespace App\Thumbnail\Domain;

use Symfony\Component\Filesystem\Filesystem;

class Image
{
    private const FILE_DIR = 'var/images/';

    public function __construct(
        private Filesystem $filesystem,
        private string     $filename,
        private ImageSize  $imageSize
    )
    {
        if ($this->filesystem->exists($this->filesystem->exists(self::FILE_DIR . $this->filename))) {
            throw new \InvalidArgumentException('File do not exists');
        }
    }

    public function filesystem(): Filesystem
    {
        return $this->filesystem;
    }

    public function fileDirectory(): string
    {
        return self::FILE_DIR;
    }

    public function filepath(): string
    {
        return self::FILE_DIR . $this->filename;
    }

    public function filename(): string
    {
        return $this->filename;
    }

    public function imageSize(): ImageSize
    {
        return $this->imageSize;
    }
}