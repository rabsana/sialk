<?php

declare(strict_types=1);

namespace Rabsana\Sialk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rabsana\Sialk\Sialk
 */
class Sialk extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Rabsana\Sialk\Sialk::class;
    }
}
