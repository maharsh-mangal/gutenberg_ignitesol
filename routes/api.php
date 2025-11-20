<?php


use App\Http\Controllers\Api\BookController;

Route::get('/books', [BookController::class, 'index']);
