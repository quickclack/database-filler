<?php

declare(strict_types=1);

namespace Quickclack\Fillers\Providers;

use Illuminate\Support\ServiceProvider;
use Quickclack\Fillers\Console\MakeFillerCommand;
use Quickclack\Fillers\Console\RunFillersCommand;

final class ArtisanCommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeFillerCommand::class,
                RunFillersCommand::class,
            ]);
        }
    }
}
