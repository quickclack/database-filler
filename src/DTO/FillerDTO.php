<?php

declare(strict_types=1);

namespace Quickclack\Fillers\DTO;

final class FillerDTO
{
    private const PHP_EXTENSION = '.php';

    public function __construct(
        private string $fileName,
        private string $path,
    ) {
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getClassName(): string
    {
        return str_replace(self::PHP_EXTENSION, '', $this->fileName);
    }
}
