<?php

declare(strict_types=1);

namespace Abelousovva\LaravelLog;

use Abelousovva\LaravelLog\Models\Log;
use Psr\Log\AbstractLogger;

class DatabaseLog extends AbstractLogger
{
    public function log(mixed $level, mixed $message, array $context = []): void
    {
        $log = new Log();
        $log->level = $level;
        $log->message = $message;
        $log->data = $context;
        $log->save();
    }
}
