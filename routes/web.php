<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:web')
    ->controller(Controllers\CharacterController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/characters/{id}', 'show')->where('id', '[1-9][0-9]{0,5}')->name('characters.show');
    });
