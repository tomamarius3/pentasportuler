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
        for($i = 0; $i < $totalMatches; $i++) {
            $homeIndex = ($i + $this->number - 1) % $totalPlayers;
            $awayIndex = ($totalPlayers - $i - 1 + $this->number - 1) % $totalPlayers;
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
    }
}
