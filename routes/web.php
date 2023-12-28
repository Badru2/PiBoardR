<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tweet\TweetCreateController;
use App\Http\Controllers\Tweet\TweetShowController;
use App\Http\Controllers\Tweet\TweetStoreController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/create', TweetCreateController::class)->name('tweet.create');
    Route::post('store', TweetStoreController::class)->name('tweet.store');
    Route::get('/show/{id}', TweetShowController::class)->name('tweet.show');

    Route::get('/like/{id}', [LikeController::class, 'toggle']);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/@{name}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
