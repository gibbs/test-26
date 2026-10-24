<?php

use App\Clients\RickAndMortyClient;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

it('sends a request with the given query', function () {
    Http::fake(['rickandmorty.test/api/character*' => Http::response(jsonFixture('characters'))]);

    expect(app(RickAndMortyClient::class)->get('character', ['name' => 'rick', 'page' => 2]))
        ->toBe(jsonFixture('characters'));

    Http::assertSent(fn ($request) => $request->url() === 'https://rickandmorty.test/api/character?name=rick&page=2'
        && $request->hasHeader('Accept', 'application/json'));
});

it('caches successful responses', function () {
    Http::fake(['*' => Http::response(jsonFixture('characters'))]);
    $client = app(RickAndMortyClient::class);

    $client->get('character', ['page' => 1, 'name' => 'rick']);
    $client->get('character', ['name' => 'rick', 'page' => 1]);

    Http::assertSentCount(1);
});

it('does not cache failed responses', function () {
    Http::fake(['*' => Http::sequence()->push(null, 500)->push(jsonFixture('characters'))]);
    $client = app(RickAndMortyClient::class);

    expect(fn () => $client->get('character'))->toThrow(RequestException::class);
    expect($client->get('character'))->toBe(jsonFixture('characters'));
});

it('does cache 404 failed responses', function () {
    Http::fake(['*' => Http::sequence()->push(null, 404)->push(jsonFixture('characters'))]);
    $client = app(RickAndMortyClient::class);

    expect(fn () => $client->get('character'))->not()->toThrow(RequestException::class);
});

it('retries when rate limited', function () {
    Http::fake(['*' => Http::sequence()->push(null, 429)->push(jsonFixture('characters'))]);

    expect(app(RickAndMortyClient::class)->get('character'))->toBe(jsonFixture('characters'));

    Http::assertSentCount(2);
});

it('throws once retries are exhausted', function () {
    Http::fake(['*' => Http::response(null, 429, ['Retry-After' => '30'])]);

    try {
        app(RickAndMortyClient::class)->get('character');
        $this->fail('Expected exception.');
    } catch (TooManyRequestsHttpException $e) {
        expect($e->getHeaders())->toBe(['Retry-After' => '30']);
    }

    Http::assertSentCount(2);
});
