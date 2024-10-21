<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    FilmController,
    ProfileController,
};

Route::get('/', [FilmController::class, 'movieHome'])->name('home');
Route::get('/movies', [FilmController::class, 'movies'])->name('movies');
Route::get('/movies/{film}', [FilmController::class, 'show'])->name('movies.show');
Route::get('/movies/genre/{genre}', [FilmController::class, 'moviesByGenre'])->name('genre');



// Menampilkan form login dengan GET dan HEAD request
Route::match(['get', 'head'], '/login', [ProfileController::class, 'showLoginForm'])->name('login');

// Memproses login dengan POST request
Route::post('/login', [ProfileController::class, 'login']);



