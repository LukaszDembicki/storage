<?php
declare(strict_types=1);

namespace App\Thumbnail\Domain;

interface Client
{
    /**
     * @throws FileUploadException
     */
    public function store(Image $image);
}