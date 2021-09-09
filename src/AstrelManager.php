<?php

namespace SustainableHustle\Astrel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AstrelManager
{
    public function all(): array
    {
        return Cache::remember('sustainable-hustle-astrel', $this->getCacheLifetime(), function () {
            return Http::asJson()
                ->baseUrl($this->getBaseUrl())
                ->withToken($this->getApiKey())
                ->get('all')
                ->throw()
                ->json();
        });
    }

    protected function getApiKey(): ?string
    {
        return config('astrel.api_key');
    }

    protected function getCacheLifetime(): ?int
    {
        return config('astrel.cache_lifetime');
    }

    protected function getBaseUrl(): string
    {
        return config('astrel.base_url');
    }
}
