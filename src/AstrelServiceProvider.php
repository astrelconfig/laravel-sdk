<?php

namespace SustainableHustle\Astrel;

use Illuminate\Support\ServiceProvider;

class AstrelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfig();
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/astrel.php', 'astrel');

        $this->app->singleton(AstrelManager::class);
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/astrel.php' => config_path('astrel.php'),
        ], ['config', 'astrel-config']);
    }
}
