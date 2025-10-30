<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemoryGameController extends Controller
{
    public function easy()
    {
        return view('memory-game.easy-mode');
    }

    public function medium()
    {
        return view('memory-game.medium-mode');
    }

    public function hard()
    {
        return view('memory-game.hard-mode');
    }
}