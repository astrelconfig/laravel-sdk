<?php

use Illuminate\Support\Facades\Http;
use SustainableHustle\Astrel\Facades\Astrel;

it('caches any subsequent call to Astrel::all()', function () {
    // Given a call to the `/all` endpoint would return an `app-name` of "Foo"
    // and a subsequent call would return an `app-name` of "Bar".
    Http::fake([
        astrelUrl('all') => Http::sequence()
            ->push(['app-name' => ['slug' => 'app-name', 'value' => 'Foo']])
            ->push(['app-name' => ['slug' => 'app-name', 'value' => 'bar']])
    ]);

    // When we access all aspects via the facade twice.
    $firstAspects = Astrel::all();
    $secondAspects = Astrel::all();

    // Then the `app-name` is "Foo" for both of these calls.
    expect($firstAspects['app-name']['value'])->toEqual('Foo');
    expect($secondAspects['app-name']['value'])->toEqual('Foo');
});
