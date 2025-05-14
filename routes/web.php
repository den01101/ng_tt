<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', static fn () => view('main_page'))
    ->name('login');

Route::get('/{code}', static fn () => view('user_page'))
    ->name('web.unique_link');
