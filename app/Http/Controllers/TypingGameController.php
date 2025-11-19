<?php

namespace App\Http\Controllers;

use App\Models\TypingGame;
use App\Models\TypingResults;
use Illuminate\Http\Request;

class TypingGameController extends Controller
{
    public function index() {
        $sentences = TypingGame::all();
        return view('typing-game.typing', compact('sentences'));
    }
    public function score() {
        $highscores = \App\Models\TypingResults::with('user')->orderBy('difficulty')->orderBy('time_seconds')->get();
        
        return view('typing-game.typingScore', compact('highscores'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'time_seconds' => 'required|numeric',
            'accuracy' => 'required|integer',
            'wpm' => 'required|integer',
            'incorrect_words' => 'required|integer',
            'incorrect_letters' => 'required|integer',
            'difficulty' => 'required|in:easy,medium,hard,hardCore'
        ]);

        $score = TypingResults::create([
            'user_id' => auth()->id(),
            'time_seconds' => $request->time_seconds,
            'accuracy' => $request->accuracy,
            'wpm' => $request->wpm,
            'incorrect_words' => $request->incorrect_words,
            'incorrect_letters' => $request->incorrect_letters,
            'difficulty' => $request->difficulty
        ]);
    }
}
