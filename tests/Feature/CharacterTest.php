<?php

use Illuminate\Support\Facades\Http;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

it('renders a character with their episodes', function () {
    Http::fake([
        'rickandmorty.test/api/character/1' => Http::response(jsonFixture('character')),
        'rickandmorty.test/api/episode/*' => Http::response(jsonFixture('episodes')),
    ]);

    get('/characters/1')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Character')
            ->where('character.name', 'Rick Sanchez')
            ->has('episodes', 2));
});

it('returns 404 for an unknown character', function () {
    Http::fake(['*' => Http::response(null, 404)]);

    get('/characters/999999')->assertNotFound();
});

it('returns 404 for an invalid id', function () {
    get('/characters/abc')->assertNotFound();
});
