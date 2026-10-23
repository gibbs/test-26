<?php

namespace App\Data;

use Illuminate\Support\Arr;

/**
 * Episode DTO
 *
 * @see https://rickandmortyapi.com/documentation#episode-schema
 */
final readonly class Episode
{
    public function __construct(
        public int $id,
        public string $name,
        public string $airDate,
        public string $episode,
    ) {}

    /** @param array<array-key, mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            id: Arr::integer($data, 'id'),
            name: Arr::string($data, 'name'),
            airDate: Arr::string($data, 'air_date'),
            episode: Arr::string($data, 'episode'),
        );
    }
}
