<?php

use Illuminate\Support\Facades\Http;
use SustainableHustle\Astrel\Facades\Astrel;

it('returns an array of all aspects from astrel', function () {
    // Given a call to the `/all` endpoint would return the following aspects.
    Http::fake([
        astrelUrl('all') => Http::response([
            'app-name' => ['slug' => 'app-name', 'value' => 'Astrel'],
            'app-headline' => ['slug' => 'app-headline', 'value' => 'Remote Config Orchestration'],
        ]),
    ]);

    // When we access all aspects via the facade.
    $aspects = Astrel::all();

    // Then we get all the expected aspects from the endpoint.
    expect($aspects)->toEqual([
        'app-name' => ['slug' => 'app-name', 'value' => 'Astrel'],
        'app-headline' => ['slug' => 'app-headline', 'value' => 'Remote Config Orchestration'],
    ]);
});
