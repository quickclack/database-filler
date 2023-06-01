<?php

declare(strict_types = 1);

namespace Quickclack\Fillers\Services;

use Illuminate\Console\View\Components\Factory as Output;

final class FillerMakingService
{
    private const DEFAULT_PATH = './database/fillers';

    public function __construct(
        private string $fillerName,
        private Output $output,
    ) {
    }

    public function make(): void
    {
        $template = file_get_contents(__DIR__ . '/../stubs/filler.stub');
        $fillerName = date('Y_m_d_His', time()) . '_' . $this->fillerName;

        file_put_contents(self::DEFAULT_PATH . '/' . $fillerName . '.php', $template);
        $this->output->info("Filler [{$fillerName}] created successfully");

        exec('chmod -R 777 ./database/fillers');
    }
}
