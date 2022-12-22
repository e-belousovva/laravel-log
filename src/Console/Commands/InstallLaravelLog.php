<?php

declare(strict_types=1);

namespace Abelousovva\LaravelLog\Console\Commands;

use Illuminate\Console\Command;

class InstallLaravelLog extends Command
{
    protected $signature = 'laravel-log:publish';

    protected $description = 'Install the LaravelLog package';

    public function handle()
    {
        $this->info('Installing LaravelLog...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Abelousovva\LaravelLog\Providers\LaravelLogServiceProvider",
            '--tag' => "config_migrations"
        ]);

        $this->info('Installed LaravelLog package');
    }
}
