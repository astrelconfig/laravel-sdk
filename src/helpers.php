<?php

use Illuminate\Support\Env;
use Illuminate\Support\Str;
use SustainableHustle\Astrel\AstrelManager;
use SustainableHustle\Astrel\Facades\Astrel;

if (! function_exists('astrel')) {
    /**
     * @param string|null $key
     * @param mixed|null $default
     * @return mixed|AstrelManager
     */
    function astrel(string $key = null, $default = null)
    {
        if (! $key) {
            return Astrel::getFacadeRoot();
        }

        return Astrel::get($key, $default);
    }
}

if (! function_exists('astrel_env')) {
    /**
     * @param string $key
     * @param mixed|null $envKey
     * @param mixed|null $default
     * @return mixed|AstrelManager
     */
    function astrel_env(string $key, string $envKey = null, $default = null)
    {
        if (! $envKey) {
            $envKey = (string) Str::of($key)->replace('-', '_')->snake()->upper();
        }

        return Astrel::get($key, Env::get($envKey, $default));
    }
}
