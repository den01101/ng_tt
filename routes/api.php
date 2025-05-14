<?php

declare(strict_types=1);

use App\Application\Controller\UniqueLink\CreateUniqueLinkAction;
use App\Application\Controller\UniqueLink\DeactivateUniqueLinkAction;
use App\Application\Controller\UniqueLink\GetHistoryAction;
use App\Application\Controller\UniqueLink\GetLuckyAction;
use App\Application\Controller\UniqueLink\GetUniqueLinkStateAction;
use App\Application\Controller\User\CreateUserAction;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(static function () {
    Route::post('create', [CreateUserAction::class, '__invoke'])->name('user.create');
});

Route::prefix('unique_link')->middleware('auth:api')->group(static function () {
    Route::post('create', [CreateUniqueLinkAction::class, '__invoke'])->name('unique_link.create');

    Route::prefix('{code}')->group(static function () {
        Route::get('state', [GetUniqueLinkStateAction::class, '__invoke'])->name('unique_link.state');
        Route::post('deactivate', [DeactivateUniqueLinkAction::class, '__invoke'])->name('unique_link.deactivate');
        Route::post('get_lucky', [GetLuckyAction::class, '__invoke'])->name('get_lucky');
        Route::get('history', [GetHistoryAction::class, '__invoke'])->name('history');
    });
});
