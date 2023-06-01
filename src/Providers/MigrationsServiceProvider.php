<?php

declare(strict_types = 1);

namespace Quickclack\Fillers\Providers;

use Illuminate\Support\ServiceProvider;

final class MigrationsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
