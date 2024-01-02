<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tweet\SearchTweetController;
use App\Http\Controllers\Tweet\TweetCreateController;
use App\Http\Controllers\Tweet\TweetDeleteController;
use App\Http\Controllers\Tweet\TweetEditController;
use App\Http\Controllers\Tweet\TweetShowController;
use App\Http\Controllers\Tweet\TweetStoreController;
use App\Http\Controllers\Tweet\TweetUpdateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('tweet/create', TweetCreateController::class)->name('tweet.create');
    Route::post('tweet/store', TweetStoreController::class)->name('tweet.store');
    Route::get('tweet/show/{id}', TweetShowController::class)->name('tweet.show');
    Route::get('tweet/edit/{id}', TweetEditController::class)->name('tweet.edit');
    Route::put('tweet/update/{id}', TweetUpdateController::class)->name('tweet.update');
    Route::delete('tweet/delete/{id}', TweetDeleteController::class)->name('tweet.destroy');

    Route::get('/like/{id}', [LikeController::class, 'toggle']);
    Route::get('/favorite/{id}', [FavoriteController::class, 'toggle']);
    Route::get('/search/', SearchTweetController::class)->name('search');
    Route::get('/follow/{user_id}', [ProfileController::class, 'follow'])->name('user.follow');

    Route::put('ToAdmin/{id}', [ProfileController::class, 'toAdmin'])->name('toAdmin');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/@{name}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
