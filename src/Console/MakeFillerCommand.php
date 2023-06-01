<?php

declare(strict_types = 1);

namespace Quickclack\Fillers\Console;

use Illuminate\Console\Command;
use Quickclack\Fillers\Services\FillerMakingService;

final class MakeFillerCommand extends Command
{
    protected $signature = 'make:filler {name : filler name}';

    protected $description = 'This command makes filler';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->argument('name');

        (new FillerMakingService($name, $this->components))->make();
    }
}
