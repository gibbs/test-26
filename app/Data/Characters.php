<?php

namespace App\Data;

use Illuminate\Support\Arr;

final readonly class Characters
{
    /** @param list<Character> $results */
    public function __construct(public array $results, public int $count, public int $pages) {}

    /** @param array<array-key, mixed> $data */
    public static function fromArray(array $data): self
    {
        $results = [];

        foreach (Arr::array($data, 'results') as $character) {
            $results[] = Character::fromArray((array) $character);
        }

        return new self(
            results: $results,
            count: Arr::integer($data, 'info.count'),
            pages: Arr::integer($data, 'info.pages'),
        );
    }
}
