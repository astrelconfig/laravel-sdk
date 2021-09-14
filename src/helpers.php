<?php

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
