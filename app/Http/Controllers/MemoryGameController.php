<?php

namespace App\Http\Controllers;

use App\Models\MemoryScore;
use Illuminate\Http\Request;

class MemoryGameController extends Controller
{
    public function easy() {
        return view('memory-game.easy-mode');
    }

    public function medium() {
        return view('memory-game.medium-mode');
    }

    public function hard() {
        return view('memory-game.hard-mode');
    }

    public function highscore() {
        $highscores = MemoryScore::select('user_id', 'mode')
            ->selectRaw('MIN(time_seconds) as time_seconds')
            ->with('user')
            ->groupBy('user_id', 'mode')
            ->orderBy('mode')
            ->orderBy('time_seconds')
            ->get();

        return view('memory-game.highscore', compact('highscores'));
    }

    public function saveScore(Request $request)
    {
        $validated = $request->validate([
            'mode' => 'required|in:easy,medium,hard',
            'time_seconds' => 'required|integer|min:0',
        ]);

        $score = MemoryScore::create([
            'user_id' => auth()->id(),
            'mode' => $validated['mode'],
            'time_seconds' => $validated['time_seconds'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Score saved successfully',
            'score' => $score
        ]);
    }
}