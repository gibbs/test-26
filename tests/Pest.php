<?php

use Illuminate\Support\Facades\File;
use Tests\TestCase;

pest()->extend(TestCase::class)->in('Feature', 'Unit');

/**
 * Load and decode JSON fixtures from tests/Fixtures.
 *
 * @return array<array-key, mixed>
 */
function jsonFixture(string $name): array
{
    return File::json(fixture("{$name}.json"), JSON_THROW_ON_ERROR);
}
