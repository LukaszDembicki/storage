<?php
declare(strict_types=1);

namespace App\Thumbnail\Application;

use App\Thumbnail\Domain\Client;
use App\Thumbnail\Domain\DropboxClient;
use App\Thumbnail\Domain\FTPClient;

class ClientFactory
{
    public static function fromString(string $type): Client
    {
        switch ($type) {
            case 'ftp':
                return new FTPClient();
            case 'dropbox':
                return new DropboxClient();
        }

        throw new \InvalidArgumentException('storage not supported');
    }
}