<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMatchRequest;
use App\Models\Match;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MatchController extends Controller
{

    private $password = '$2y$12$ax6sNou3lUiQYzSDtaf.B./k265/V1xnRtd.Nsl02xZW.VHsiTu6y';

    public function edit(Match $match)
    {
        return view('match', ['match' => $match]);
    }

    public function update(Match $match, UpdateMatchRequest $request) {
        if(Hash::check($request->input('password'), $this->password)) {
            $match->home_score = $request->input('home_score');
            $match->away_score = $request->input('away_score');
            $match->save();
            return back()->with('success', "GG!");
        }
        return back()->with('error', 'No cheating plx!');
    }

}
