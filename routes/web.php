<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('/genre/{genre}', function ($genre) {
    return Inertia::render('GenrePage', ['genre' => $genre]);
});

require __DIR__.'/settings.php';
