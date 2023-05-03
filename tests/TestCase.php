<?php

declare(strict_types=1);

namespace Square\Vermillion\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Square\Vermillion\VersioningServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            VersioningServiceProvider::class,
        ];
    }
}
