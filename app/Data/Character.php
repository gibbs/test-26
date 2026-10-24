<?php

namespace App\Data;

use App\Services\Imgproxy;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
        /** @var list<int> */
        public array $episodeIds = [],
        public string $srcset = '',
    ) {}

    /** @param array<array-key, mixed> $data */
    public static function fromArray(array $data, ?Imgproxy $imgproxy = null): self
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
            episodeIds: self::getEpisodeIds(Arr::array($data, 'episode')),
            srcset: $imgproxy?->srcset(Arr::string($data, 'image')) ?? '',
        );
    }

    /**
     * Return only episode IDs from URLs
     *
     * @param  array<array-key, mixed>  $urls
     * @return list<int>
     */
    private static function getEpisodeIds(array $urls): array
    {
        $ids = [];

        foreach ($urls as $url) {
            $id = is_string($url) ? (int) Str::afterLast($url, '/') : 0;

            if ($id === 0) {
                continue;
            }

            $ids[] = $id;
        }

        return $ids;
    }
}
