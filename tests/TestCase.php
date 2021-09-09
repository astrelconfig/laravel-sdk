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
        $app->config['astrel.base_url'] = 'http://astrel.test/api';
        $app->config['astrel.api_key'] = 'sxjTgAJAxkT2TNyKf9vaaFI0L07AyItM5o3iikkS';
    }
}
