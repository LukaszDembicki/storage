<?php
declare(strict_types=1);

namespace App\Thumbnail\Domain;

class ImageSize
{
    public function __construct(
        private ?int $width,
        private ?int $height
    )
    {
        if ($this->width === null && $this->height === null) {
            throw new \InvalidArgumentException('Width or height has to be defined');
        }
    }

    public function width(): ?int
    {
        return $this->width;
    }

    public function height(): ?int
    {
        return $this->height;
    }
}