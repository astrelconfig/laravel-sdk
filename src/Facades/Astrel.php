<?php

namespace SustainableHustle\Astrel\Facades;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Facade;
use SustainableHustle\Astrel\AstrelManager;

/**
 * @see AstrelManager
 *
 * @method static mixed get(string $slug, mixed $default = null)
 * @method static array all()
 * @method static void flush()
 * @method static array refetch()
 * @method static Route webhookRoute(string $uri = null)
 */
class Astrel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AstrelManager::class;
    }
}
