<?php

use Illuminate\Support\Str;

function astrelUrl(string $suffix): string
{
    return Str::finish(config('astrel.base_url'), '/') . $suffix;
}
