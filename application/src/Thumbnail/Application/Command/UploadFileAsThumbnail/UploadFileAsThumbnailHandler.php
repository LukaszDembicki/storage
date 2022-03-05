<?php
declare(strict_types=1);

namespace App\Thumbnail\Application\Command\UploadFileAsThumbnail;

use App\Shared\Image\ImageProcessorInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UploadFileAsThumbnailHandler implements MessageHandlerInterface
{
    public function __construct(
        private ImageProcessorInterface $imageProcessor
    )
    {
    }

    /**
     * @throws \App\Thumbnail\Domain\FileUploadException
     */
    public function __invoke(UploadFileAsThumbnail $uploadFileAsThumbnail)
    {
        $imageAfterResize = $this->imageProcessor->resizeToMaxLength(
            max($uploadFileAsThumbnail->image()->imageSize()->width(), $uploadFileAsThumbnail->image()->imageSize()->height()),
            $uploadFileAsThumbnail->image()
        );

        $uploadFileAsThumbnail->client()->store($imageAfterResize);
    }
}