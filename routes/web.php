<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:web')
    ->controller(Controllers\CharacterController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });
