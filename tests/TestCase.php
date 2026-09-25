<?php

declare(strict_types=1);

namespace Rabsana\Sialk\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Rabsana\Sialk\SialkServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            SialkServiceProvider::class,
        ];
    }
}
