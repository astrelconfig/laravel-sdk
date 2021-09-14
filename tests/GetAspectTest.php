<?php

use Illuminate\Support\Facades\Http;
use SustainableHustle\Astrel\AstrelManager;
use SustainableHustle\Astrel\Facades\Astrel;

it('returns an individual aspect from astrel', function () {
    // Given a call to the `/all` endpoint would return the following aspects.
    Http::fake([
        astrelUrl('all') => Http::response([
            'app-name' => ['slug' => 'app-name', 'value' => 'Astrel'],
            'app-headline' => ['slug' => 'app-headline', 'value' => 'Remote Config Orchestration'],
        ]),
    ]);

    // When we access the `app-name` aspect.
    $aspectValue = Astrel::get('app-name');

    // Then we get the value of the `app-name` aspect.
    expect($aspectValue)->toEqual('Astrel');
});

it('returns a default value when an aspect does not exist', function () {
    // Given a call to the `/all` endpoint would return the following aspects.
    Http::fake([
        astrelUrl('all') => Http::response([
            'app-name' => ['slug' => 'app-name', 'value' => 'Astrel'],
            'app-headline' => ['slug' => 'app-headline', 'value' => 'Remote Config Orchestration'],
        ]),
    ]);

    // When we access a missing `app-discount-code` aspect with a default value.
    $aspectValue = Astrel::get('app-discount-code', 'SUMMER20OFF');

    // Then we get the default value.
    expect($aspectValue)->toEqual('SUMMER20OFF');
});

it('provides an astrel helper method', function () {
    // Given a call to the `/all` endpoint would return the following aspects.
    Http::fake([
        astrelUrl('all') => Http::response([
            'app-name' => ['slug' => 'app-name', 'value' => 'Astrel'],
            'app-headline' => ['slug' => 'app-headline', 'value' => 'Remote Config Orchestration'],
        ]),
    ]);

    // Then we can access a value using the `astrel` helper method.
    expect(astrel('app-name'))->toBe('Astrel');

    // And it can provide a default value.
    expect(astrel('app-discount-code', 'SUMMER20OFF'))->toBe('SUMMER20OFF');

    // And it returns the AstrelManager when no arguments are given.
    expect(astrel())->toBe(app(AstrelManager::class));
});
