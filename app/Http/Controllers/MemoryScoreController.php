<?php

namespace App\Http\Controllers;

use App\Models\MemoryScore;
use Illuminate\Http\Request;

class MemoryScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch only each user's fastest time for every mode
        $highscores = MemoryScore::select('user_id', 'mode')
            ->selectRaw('MIN(time_seconds) as time_seconds')
            ->with('user')
            ->groupBy('user_id', 'mode')
            ->orderBy('mode')
            ->orderBy('time_seconds')
            ->get();

        return view('memory-scores.index', compact('highscores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'time_seconds' => 'required|integer',
            'mode' => 'required|in:easy,medium,hard'
        ]);

        $score = MemoryScore::create([
            'time_seconds' => $request->time_seconds,
            'mode' => $request->mode,
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Score saved successfully',
            'score' => $score
        ]);
    }
}
