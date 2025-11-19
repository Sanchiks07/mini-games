<?php

namespace App\Http\Controllers;

use App\Models\TypingGame;
use Illuminate\Http\Request;

class TypingGameController extends Controller
{
    public function index() {
        $sentences = TypingGame::all();
        return view('typing-game.typing', compact('sentences'));
    }
}
