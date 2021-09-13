<?php

use Illuminate\Support\Facades\Http;
use SustainableHustle\Astrel\Facades\Astrel;

it('refetches all aspects when receiving the webhook from astrel', function () {
    // Given a call to the `/all` endpoint would return an `app-name` of "Foo"
    // and a subsequent call would return an `app-name` of "Bar".
    Http::fake([
        astrelUrl('all') => Http::sequence()
            ->push(['app-name' => ['slug' => 'app-name', 'value' => 'Foo']])
            ->push(['app-name' => ['slug' => 'app-name', 'value' => 'Bar']]),
    ]);

    // And we have the webhook route registered.
    Astrel::webhookRoute()->name('astrel.webhook');

    // And we've already cached aspects from Astrel.
    Astrel::all();

    // When we trigger that webhook.
    $this->post(route('astrel.webhook'));

    // Then the cache was flushed and refetched.
    $aspects = Astrel::all();
    expect($aspects['app-name']['value'])->toBe('Bar');
});
