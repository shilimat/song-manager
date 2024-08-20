<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChapaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Songs Routes (Admin: CRUD; User: View)
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
        Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
        Route::get('/songs/{song}/edit', [SongController::class, 'edit'])->name('songs.edit');
        Route::put('/songs/{song}', [SongController::class, 'update'])->name('songs.update');
        Route::delete('/songs/{song}', [SongController::class, 'destroy'])->name('songs.destroy');
    });

    Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
    Route::get('/songs/{song}', [SongController::class, 'show'])->name('songs.show');
});

// Artist Routes (Admin: CRUD; User: View)
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/artists/create', [ArtistController::class, 'create'])->name('artists.create');
        Route::post('/artists', [ArtistController::class, 'store'])->name('artists.store');
        Route::get('/artists/{artist}/edit', [ArtistController::class, 'edit'])->name('artists.edit');
        Route::put('/artists/{artist}', [ArtistController::class, 'update'])->name('artists.update');
        Route::delete('/artists/{artist}', [ArtistController::class, 'destroy'])->name('artists.destroy');
    });

    Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');
    Route::get('/artists/{artist}', [ArtistController::class, 'show'])->name('artists.show');
});

// Genre Routes (Admin: CRUD; User: View)
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create');
        Route::post('/genres', [GenreController::class, 'store'])->name('genres.store');
        Route::get('/genres/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
        Route::put('/genres/{genre}', [GenreController::class, 'update'])->name('genres.update');
        Route::delete('/genres/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy');
    });

    Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
    Route::get('/genres/{id}', [GenreController::class, 'show'])->name('genres.show');
});

// Album Routes (Admin: CRUD; User: View)
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
        Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
        Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
        Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
        Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');
    });

    Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationNotificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');
});

Route::middleware('auth')->group(function () {
    Route::get('/payment', [ChapaController::class, 'showPaymentForm'])->name('payment');
    Route::post('pay', 'App\Http\Controllers\ChapaController@initialize')->name('pay');
    Route::get('callback/{reference}', 'App\Http\Controllers\ChapaController@callback')->name('callback');
});



// Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
