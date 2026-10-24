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

it('returns episodes for several ids in one request', function () {
    Http::fake(['*' => Http::response(jsonFixture('episodes'))]);

    expect(app(RickAndMortyService::class)->episodes([1, 2]))->toHaveCount(2);

    Http::assertSent(fn ($request) => str_ends_with($request->url(), '/episode/1,2'));
});

it('returns a list when a single episode is requested', function () {
    Http::fake(['*' => Http::response(jsonFixture('episodes')[0])]);

    expect(app(RickAndMortyService::class)->episodes([1]))->toHaveCount(1);
});

it('does not send a request without episode ids', function () {
    Http::fake();

    expect(app(RickAndMortyService::class)->episodes([]))->toBe([]);

    Http::assertNothingSent();
});
