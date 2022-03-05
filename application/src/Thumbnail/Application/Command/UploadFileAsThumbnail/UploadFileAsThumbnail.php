<?php
declare(strict_types=1);

namespace App\Thumbnail\Application\Command\UploadFileAsThumbnail;

use App\Thumbnail\Domain\Client;
use App\Thumbnail\Domain\Image;

class UploadFileAsThumbnail
{
    public function __construct(
        private Client    $client,
        private Image $image
    )
    {
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function image(): Image
    {
        return $this->image;
    }
}