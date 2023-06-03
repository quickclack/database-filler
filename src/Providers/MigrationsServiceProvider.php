<?php

declare(strict_types = 1);

namespace Quickclack\Fillers\Providers;

use Illuminate\Support\ServiceProvider;

final class MigrationsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__. '/../database/fillers' => database_path('database')
        ]);

        $this->publishes([
            __DIR__. '/../database/migrations' => database_path('migrations')
        ]);
    }
}
