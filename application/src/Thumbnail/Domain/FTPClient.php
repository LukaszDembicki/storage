<?php
declare(strict_types=1);

namespace App\Thumbnail\Domain;

use Touki\FTP\Connection\Connection;
use Touki\FTP\FTPFactory;
use Touki\FTP\Model\File;

class FTPClient implements Client
{
    private const IP = '';
    private const USER = '';
    private const PASSWORD = 'i';
    private const DESTINATION_PATH = '/dir/';

    public function store(Image $image)
    {
        try {
            $ftpFactory = new FTPFactory();
            $connection = new Connection(
               self::IP,
               self::USER,
                self::PASSWORD
            );
            $ftp = $ftpFactory->build($connection);
            $ftp->upload(
                new File(self::DESTINATION_PATH . $image->filename()),
                $image->filepath()
            );
        } catch (\Exception $exception) {
            throw new FileUploadException(sprintf('File upload failed: %s', $exception->getMessage()));
        }
    }
}