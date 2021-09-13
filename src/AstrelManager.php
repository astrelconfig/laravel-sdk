<?php

namespace SustainableHustle\Astrel;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route as Router;

class AstrelManager
{
    public function get(string $slug, mixed $default = null): mixed
    {
        return $this->all()[$slug]['value'] ?? $default;
    }

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

    public function flush(): void
    {
        Cache::forget('sustainable-hustle-astrel');
    }

    public function refetch(): array
    {
        $this->flush();

        return $this->all();
    }

    public function webhookRoute(string $uri = null): Route
    {
        return Router::post($uri ?? config('astrel.webhook.uri'), function () {
            $this->refetch();
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
