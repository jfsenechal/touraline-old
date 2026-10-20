<?php

declare(strict_types=1);

use App\Http\Controllers\ConcertController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/concerts/{concert}', [ConcertController::class, 'show'])->name('concerts.show');
