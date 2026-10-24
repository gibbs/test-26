<?php

use App\Data\Character;
use App\Data\Characters;

it('maps paginated characters dto', function () {
    expect(Characters::fromArray(jsonFixture('characters')))
        ->count->toBe(826)
        ->pages->toBe(42)
        ->results->toHaveCount(2)->each->toBeInstanceOf(Character::class);
});

it('rejects invalid payload', function () {
    Character::fromArray(['id' => 'not-an-int']);
})->throws(InvalidArgumentException::class);
