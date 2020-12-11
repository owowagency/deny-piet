<?php

namespace OwowAgency\DenyPiet\Tests;

use OwowAgency\DenyPiet\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithTime;

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}
