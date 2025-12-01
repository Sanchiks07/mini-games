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
        $highscores = TypingResults::with('user')
            ->orderBy('difficulty')
            ->orderByDesc('accuracy')
            ->orderByDesc('wpm')
            ->orderBy('incorrect_words')
            ->orderBy('time_seconds')
            ->get();
        
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

        if ($request->accuracy < 50) {
            return;
        }

        if ($request->wpm > 300) {
            return;
        }

        if ($request->incorrect_words > $request->wpm) {
            return;
        }


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
