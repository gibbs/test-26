<?php

namespace App\Clients;

use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

final readonly class RickAndMortyClient
{
    /**
     * @param  array{0: int, 1: int}  $cache
     */
    public function __construct(
        #[Config('services.rick_and_morty.url')] private string $url,
        #[Config('services.rick_and_morty.timeout')] private int $timeout,
        #[Config('services.rick_and_morty.attempts')] private int $attempts,
        #[Config('services.rick_and_morty.cache')] private array $cache,
    ) {}

    /**
     * Get a cached response or send/defer an API request
     *
     * @param  array<string, mixed>  $query
     * @return array<array-key, mixed>
     *
     * @throws RequestException
     * @throws TooManyRequestsHttpException
     */
    public function get(string $path, array $query = []): array
    {
        // Sort the query for consistent caching
        ksort($query);

        // Defer stale cache item requests
        return Cache::flexible(
            $this->getCacheKey($path, $query),
            $this->cache,
            fn (): array => $this->request($path, $query)
        );
    }

    /**
     * Send an API request
     *
     * @param  array<string, mixed>  $query
     * @return array<array-key, mixed>
     */
    private function request(string $path, array $query): array
    {
        $response = Http::baseUrl($this->url)
            ->acceptJson()
            ->timeout($this->timeout)
            ->retry(
                times: $this->attempts,
                sleepMilliseconds: 500,
                when: $this->requestIsRateLimited(...),
                throw: false,
            )
            ->get($path, $query);

        // Finally give up if retries fail due to persistent 429
        if ($response->tooManyRequests()) {
            throw new TooManyRequestsHttpException($response->header('retry-after') ?: null, 'API limit exceeded.');
        }

        // Cache 404 responses to reduce redundant API requests
        if ($response->notFound()) {
            return ['data' => []];
        }

        return (array) $response->throw()->json();
    }

    /**
     * Return a cache key for a path and query parameters
     *
     * @param  array<string, mixed>  $query
     */
    private function getCacheKey(string $path, array $query = []): string
    {
        return sprintf('api-request:%s', hash('sha256', $path.'?'.http_build_query($query)));
    }

    /**
     * Determine if the exception is a 429 "Too Many Requests"
     */
    private function requestIsRateLimited(Throwable $e): bool
    {
        return $e instanceof RequestException && $e->response->tooManyRequests();
    }
}
