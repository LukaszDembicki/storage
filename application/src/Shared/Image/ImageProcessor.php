<?php
declare(strict_types=1);

namespace App\Shared\Image;

use App\Thumbnail\Domain\Image;
use App\Thumbnail\Domain\ImageSize;
use Gumlet\ImageResize;

class ImageProcessor implements ImageProcessorInterface
{
    public function resizeToMaxLength(int $maxLength, Image $image): Image
    {
        $img = new ImageResize($image->filepath());
        $img->resizeToLongSide($maxLength);
        $img->save($image->filepath());

        return new Image(
            $image->filesystem(),
            $image->filename(),
            new ImageSize($img->getDestWidth(), $img->getDestHeight())
        );
    }
}
