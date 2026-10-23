<?php

use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

it('renders the home page', function () {
    get('/')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Home')
            ->where('appName', config('app.name')));
});
