<?php

declare(strict_types=1);

namespace Abelousovva\LaravelLog\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * @param string $level
     */
    protected array $casts = [
        'data' => 'json'
    ];

}