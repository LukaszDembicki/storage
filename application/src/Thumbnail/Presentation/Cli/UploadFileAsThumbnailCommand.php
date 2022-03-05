<?php
declare(strict_types=1);

namespace App\Thumbnail\Presentation\Cli;

use App\Thumbnail\Application\ClientFactory;
use App\Thumbnail\Application\Command\UploadFileAsThumbnail\UploadFileAsThumbnail;
use App\Thumbnail\Domain\Image;
use App\Thumbnail\Domain\ImageSize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Messenger\MessageBusInterface;

class UploadFileAsThumbnailCommand extends Command
{
    public const UPLOAD_FILE_AS_THUMBNAIL_COMMAND = 'upload-file-as-thumbnail';

    private const THUMBNAIL_SIZE = 'thumbnail-size';
    private const FILE_NAME = 'file-name';
    private const UPLOAD_SOURCE = 'upload-source';

    public function __construct(
        private MessageBusInterface $messageBus,
        private Filesystem          $filesystem,
        string                      $name = null
    )
    {
        parent::__construct($name);
    }

    protected
    function configure(): void
    {
        parent::configure();

        $this->setName(self::UPLOAD_FILE_AS_THUMBNAIL_COMMAND)
            ->setDescription('Resize given file to thumbnail and uploads it to specified source')
            ->addArgument(self::THUMBNAIL_SIZE, InputArgument::REQUIRED)
            ->addArgument(self::FILE_NAME, InputArgument::REQUIRED)
            ->addArgument(self::UPLOAD_SOURCE, InputArgument::REQUIRED)
            ->setHelp('
                * Allowed max thumbnail size 150 px
                * File name
                * Allowed upload source: ftp, dropbox, ...
                * Usage example: <command name> 150 image.jpg ftp
            ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $maxThumbnailSize = (int)$input->getArgument(self::THUMBNAIL_SIZE);
        $this->messageBus->dispatch(new UploadFileAsThumbnail(
            ClientFactory::fromString($input->getArgument(self::UPLOAD_SOURCE)),
            new Image(
                $this->filesystem,
                $input->getArgument(self::FILE_NAME),
                new ImageSize($maxThumbnailSize, $maxThumbnailSize)
            )
        ));

        return self::SUCCESS;
    }
}
