<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class League extends Model
{

    protected $table = 'leagues';

    protected $fillable = [
        'edition_id',
        'name',
        'slug',
        'rank',
        'promotions',
        'demotions'
    ];

    public function edition()
    {
        return $this->belongsTo(ActiveEdition::class);
    }

    public function phases()
    {
        return $this->hasMany(Phase::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'league_player');
    }

    public function matches()
    {
        return $this->hasManyThrough(Match::class, Phase::class);
    }

    public function generatePhases()
    {
        $totalPhases = $this->players->count() - 1;
        $randomOrderPlayers = $this->players()->inRandomOrder()->get();
        $today = Carbon::now();
        for($i = 1; $i <= $totalPhases; ++$i) {
            /** @var Phase $phase */
            $phase = Phase::create([
                'league_id' => $this->id,
                'number' => $i,
                'date' => $today->next(Carbon::MONDAY)->addWeek()
            ]);
            $phase->createMatches($randomOrderPlayers);
        }
    }

    public function getScoreboardPlayers()
    {
        $players = DB::select('SELECT p.id, p.first_name as firstName, p.last_name as lastName,
                (SELECT COUNT(id) FROM matches WHERE
                    phase_id IN (SELECT id FROM phases where league_id = l.id) AND
                    (
                        (home_player_id = p.id AND home_score > away_score) OR
                        (away_player_id = p.id AND home_score < away_score)
                    )
                    ) as wonMatches,
                (SELECT COUNT(id) FROM matches WHERE
                    phase_id IN (SELECT id FROM phases where league_id = l.id) AND
                    (home_player_id = p.id OR away_player_id = p.id) AND
                    home_score != away_score
                    ) as playedMatches,
                (SELECT SUM(home_score) FROM matches WHERE
                    phase_id IN (SELECT id FROM phases where league_id = l.id) AND
                    (home_player_id = p.id)
                    ) +
                    (SELECT SUM(away_score) FROM matches WHERE
                            phase_id IN (SELECT id FROM phases where league_id = l.id) AND
                        (away_player_id = p.id)
                    ) as wonSets
        FROM players p
                 JOIN league_player lp ON p.id = lp.player_id
                 JOIN leagues l ON lp.league_id = l.id
                 LEFT JOIN phases ph on l.id = ph.league_id
        WHERE l.id = ?
        GROUP BY p.id, p.first_name, p.last_name
        ORDER BY wonMatches DESC, playedMatches DESC', [$this->id]);

        return $this->orderPlayers($players);
    }

    public function orderPlayers(array $players)
    {
        $orderedPlayers = [];
        $previousPlayerWonMatches = 0;
        $toReorder = [];
        $totalPlayers = count($players);
        foreach($players as $key => $player) {
            if($key == 0) {
                $toReorder[] = $player;
            } elseif($player->wonMatches == $previousPlayerWonMatches) {
                $toReorder[] = $player;
            } else {
                $partiallyOrderedPlayers = $this->reorder($toReorder);
                $toReorder = [$player];
                foreach($partiallyOrderedPlayers as $orderedPlayer) {
                    $orderedPlayers[] = $orderedPlayer;
                }
            }
            if($key == $totalPlayers - 1) {
                $partiallyOrderedPlayers = $this->reorder($toReorder);
                foreach($partiallyOrderedPlayers as $orderedPlayer) {
                    $orderedPlayers[] = $orderedPlayer;
                }
            }
            $previousPlayerWonMatches = $player->wonMatches;
        }
        return $orderedPlayers;
    }

    private function reorder(array $toReorder)
    {
        return $toReorder;
        if(count($toReorder) == 1 || count($toReorder) > 3){
            return $toReorder;
        }
        $playerIds = [];
        foreach($toReorder as $player) {
            $playerIds[] = $player->id;
        }

        $a = $toReorder[0];
        $b = $toReorder[1];
        $c = $toReorder[2];

        $abMatch = Match::getMatchForPlayerIds($a, $b);
        $bcMatch = Match::getMatchForPlayerIds($b, $c);
        $caMatch = Match::getMatchForPlayerIds($c, $a);



        return $toReorder;
    }
}
