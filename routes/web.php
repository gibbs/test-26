<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('throttle:web')->group(function () {
    Route::get('/', fn () => Inertia::render('Home', ['appName' => config('app.name')]))->name('home');
});
