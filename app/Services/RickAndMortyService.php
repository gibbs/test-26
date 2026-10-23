<?php

namespace App\Services;

use App\Clients\RickAndMortyClient;
use App\Data\Character;
use App\Data\Characters;

final readonly class RickAndMortyService
{
    public function __construct(private RickAndMortyClient $client) {}

    /**
     * Return characters with filters
     *
     * @param  array<string, mixed>  $filters
     */
    public function characters(array $filters = []): Characters
    {
        $data = $this->client->get('character', $filters);

        // Handle no data returned (e.g. 404)
        if ($data === null) {
            return new Characters([], 0, 0);
        }

        return Characters::fromArray($data);
    }

    /**
     * Return a single character
     */
    public function character(int $id): ?Character
    {
        $path = sprintf('character/%u', $id);
        $data = $this->client->get($path);

        return $data === null ? null : Character::fromArray($data);
    }
}
