<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MemoryGameController;
use App\Http\Middleware;

Route::get('/welcome', function () {return view('welcome');})->name('welcome')->middleware('auth');

require __DIR__.'/auth.php';

Route::get('/register', function () { return view('auth.register'); })->name('register')->middleware('guest');
Route::get('/', function () { return view('auth.login'); })->name('login.form')->middleware('guest');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');

Route::post('register', [RegisteredUserController::class, 'store'])->middleware('guest');

// MEMORY GAME
Route::get('/memory-games', function () { return view('memory-game.modes'); })->name('modes')->middleware('auth');
Route::get('/memory-game/easy', [MemoryGameController::class, 'easy'])->name('memory-game.easy')->middleware('auth');
Route::get('/memory-game/medium', [MemoryGameController::class, 'medium'])->name('memory-game.medium')->middleware('auth');
Route::get('/memory-game/hard', [MemoryGameController::class, 'hard'])->name('memory-game.hard')->middleware('auth');
// highscore board
Route::get('/memory-game/highscore', [MemoryGameController::class, 'highscore'])->name('memory-game.highscore')->middleware('auth');
// saves time score
Route::post('/memory-game/save-score', [MemoryGameController::class, 'saveScore'])->name('memory-game.save-score')->middleware('auth');
