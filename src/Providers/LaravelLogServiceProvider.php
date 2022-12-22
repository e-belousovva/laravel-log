<?php

declare(strict_types=1);

namespace Abelousovva\LaravelLog\Providers;

use Abelousovva\LaravelLog\Console\Commands\InstallLaravelLog;
use Abelousovva\LaravelLog\DatabaseLog;
use Abelousovva\LaravelLog\FileLog;
use Abelousovva\LaravelLog\LaravelLog;
use Illuminate\Support\ServiceProvider;

class LaravelLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        // register the authentication log into the service container
        $this->app->bind('laravel-log', function () {
            return match (config('laravel_log.type')) {
                'db' => new DatabaseLog(),
                default => new FileLog(),
            };
        });

        // register the facade for the audit log
        $this->app->alias('laravel-log', match (config('laravel_log.type')) {
            'db' => DatabaseLog::class,
            default => FileLog::class,
        });

        $this->publishes([
            __DIR__ . '/../../database/migrations/' => database_path('migrations'),
            __DIR__ . '/../../config/laravel_log.php' => config_path('laravel_log.php'),
        ], 'config_migrations');

        $this->app->singleton('laravel-log:publish', function () {
            return new InstallLaravelLog();
        });

        $this->commands('laravel-log:publish');
    }
}
