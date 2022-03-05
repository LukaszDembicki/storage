<?php
declare(strict_types=1);

namespace App\Shared\Image;

use App\Thumbnail\Domain\Image;

interface ImageProcessorInterface
{
    public function resizeToMaxLength(int $maxLength, Image $image): Image;
}