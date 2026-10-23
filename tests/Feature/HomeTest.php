<?php

use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;

it('renders the home page', function () {
    Http::fake(['*' => Http::response(jsonFixture('characters'))]);

    get('/')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Home')
        );
});
