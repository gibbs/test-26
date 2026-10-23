<?php

namespace App\Data;

use Illuminate\Support\Arr;

/**
 * Character DTO
 *
 * @see https://rickandmortyapi.com/documentation#character-schema
 */
final readonly class Character
{
    public function __construct(
        public int $id,
        public string $name,
        public string $status,
        public string $species,
        public string $type,
        public string $gender,
        public string $image,
        public string $origin,
        public string $location,
        /** @var array<array-key, mixed> */
        public array $episodes = [],
    ) {}

    /** @param array<array-key, mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            id: Arr::integer($data, 'id'),
            name: Arr::string($data, 'name'),
            status: Arr::string($data, 'status'),
            species: Arr::string($data, 'species'),
            type: Arr::string($data, 'type'),
            gender: Arr::string($data, 'gender'),
            image: Arr::string($data, 'image'),
            origin: Arr::string($data, 'origin.name'),
            location: Arr::string($data, 'location.name'),
            episodes: Arr::array($data, 'episode'),
        );
    }
}
