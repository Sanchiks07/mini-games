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
