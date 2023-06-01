<?php

declare(strict_types=1);

namespace Quickclack\Fillers\Console;

use Illuminate\Console\Command;
use Fillers\Services\FillerRunningService;

final class RunFillersCommand extends Command
{
    protected $signature = 'db:fill';

    protected $description = 'This command runs fillers that have not yet been run';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        (new FillerRunningService($this->output))->runAll();
    }
}
