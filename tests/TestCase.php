<?php

namespace SustainableHustle\Astrel\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use SustainableHustle\Astrel\AstrelServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            AstrelServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        //
    }
}
