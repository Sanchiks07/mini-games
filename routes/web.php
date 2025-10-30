<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';

Route::get('/register', function () { return view('auth.register'); });
Route::get('/login', function () { return view('auth.login'); });

Route::post('register', [RegisteredUserController::class, 'store']);


// MEMORY GAME
Route::get('/memory-game/easy', [MemoryGameController::class, 'easy'])->name('memory-game.easy');
Route::get('/memory-game/medium', [MemoryGameController::class, 'medium'])->name('memory-game.medium');
Route::get('/memory-game/hard', [MemoryGameController::class, 'hard'])->name('memory-game.hard');
