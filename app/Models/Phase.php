<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Phase extends Model
{

    protected $table = "phases";

    protected $fillable = [
        'league_id',
        'number',
        'date'
    ];

    protected $dates = [
        'date'
    ];

    public function matches()
    {
        return $this->hasMany(Match::class);
    }

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function createMatches(Collection $players)
    {
        if($players->count() % 2 == 1) {
            $player = new \StdClass();
            $player->id = NULL;
            $players->push($player);
        }
        $totalPlayers = $players->count();
        $totalMatches = (int)($totalPlayers / 2);
        $homePlayers = collect();
        $homePlayers->push($players->get(0));
        $players->shift();
        $number = $this->number;
        while(--$number) {
            $player = $players->pop();
            $players->prepend($player);
        }
        for($i = 0; $i < $totalMatches - 1; $i++) {
            $homePlayers->push($players->get($i));
        }
        $awayPlayers = collect();
        for($i = 2 * $totalMatches - 2; $i >= $totalMatches - 1 ; $i--) {
            $awayPlayers->push($players->get($i));
        }

        for($i = 0; $i < $totalMatches; $i++) {
            Match::create([
                'phase_id' => $this->id,
                'home_player_id' => $homePlayers->get($i)->id,
                'away_player_id' => $awayPlayers->get($i)->id,
                'home_score' => 0,
                'away_score' => 0,
            ]);
        }
    }
}
