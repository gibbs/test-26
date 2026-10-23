<?php

use App\Services\RickAndMortyService;
use Illuminate\Support\Facades\Http;

it('returns a character', function () {
    Http::fake(['*' => Http::response(jsonFixture('character'))]);

    expect(app(RickAndMortyService::class)->character(1))
        ->id->toBe(1)
        ->name->toBe('Rick Sanchez');
});

it('returns null when a character is not found', function () {
    Http::fake(['*' => Http::response(null, 404)]);

    expect(app(RickAndMortyService::class)->character(999))->toBeNull();
});

it('returns no characters when none are found', function () {
    Http::fake(['*' => Http::response(null, 404)]);

    expect(app(RickAndMortyService::class)->characters(['name' => 'nobody']))
        ->results->toBe([])
        ->count->toBe(0)
        ->pages->toBe(0);
});
