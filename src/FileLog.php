<?php

declare(strict_types=1);

namespace Abelousovva\LaravelLog;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Psr\Log\AbstractLogger;

class FileLog extends AbstractLogger
{
    protected string $path;

    protected string $disk;

    public function __construct()
    {
        $this->path = config('laravel_log.path');
        $this->disk = config('laravel_log.disk');
    }

    public function log($level, mixed $message, array $context = []): void
    {
        $context = strtoupper($level) . ' ' . Carbon::now() . ' ' . $message . ' ' . implode(',', $context);
        Storage::disk($this->disk)->append($this->path, $context);
    }
}
