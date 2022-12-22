<?php

declare(strict_types=1);

namespace Abelousovva\LaravelLog\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * @method static void info(string $message, array $context = [])
 */
class Log extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-log';
    }
}