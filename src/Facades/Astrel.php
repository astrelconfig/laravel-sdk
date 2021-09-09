<?php

namespace SustainableHustle\Astrel\Facades;

use Illuminate\Support\Facades\Facade;
use SustainableHustle\Astrel\AstrelManager;

/**
 * @see AstrelManager
 */
class Astrel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AstrelManager::class;
    }
}
