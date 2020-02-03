<?php

namespace App\Http\Controllers;

use App\Models\League;

class LeagueController extends Controller
{

    public function index(League $league)
    {
        return view('scoreboard', ['league' => $league]);
    }

    public function matches(League $league)
    {
        return view('matches', ['league' => $league]);
    }

}
