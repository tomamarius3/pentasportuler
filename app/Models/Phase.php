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
        $totalPlayers = $players->count();
        $totalMatches = $totalPlayers / 2;
        if($this->number <= $totalMatches) {
            for($i = 0; $i < $totalMatches; $i++) {
                $homeIndex = ($i + $this->number - 1) % $totalPlayers;
                $awayIndex = ($totalPlayers - $i - 1 + $this->number - 1 ) % $totalPlayers;
                $homePlayer = $players->get($homeIndex);
                $awayPlayer = $players->get($awayIndex);
                Match::create([
                    'phase_id' => $this->id,
                    'home_player_id' => $homePlayer->id,
                    'away_player_id' => $awayPlayer->id,
                    'home_score' => 0,
                    'away_score' => 0,
                ]);
            }
        } else {
            $playersClone = clone $players;
            for($i = 0; $i < $totalMatches - 1; $i++) {
                $homeIndex = ($i + $this->number - 1) % $totalPlayers;
                $awayIndex = ($totalPlayers - $i - 1 + $this->number - 1 - 1) % $totalPlayers;
                $homePlayer = $players->get($homeIndex);
                $awayPlayer = $players->get($awayIndex);
                $playersClone->put($homeIndex, false);
                $playersClone->put($awayIndex, false);
                Match::create([
                    'phase_id' => $this->id,
                    'home_player_id' => $homePlayer->id,
                    'away_player_id' => $awayPlayer->id,
                    'home_score' => 0,
                    'away_score' => 0,
                ]);
            }
            $p1 = false;
            $p2 = false;
            foreach($playersClone as $player) {
                if($player != false) {
                    if($p1 == false) {
                        $p1 = $player;
                    } else {
                        $p2 = $player;
                    }
                }
            }
            if($p1 != false && $p2 != false) {
                Match::create([
                    'phase_id' => $this->id,
                    'home_player_id' => $p1->id,
                    'away_player_id' => $p2->id,
                    'home_score' => 0,
                    'away_score' => 0,
                ]);
            }
        }
    }
}
