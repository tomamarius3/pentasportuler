<?php

namespace App\Console\Commands;

use App\Models\League;
use App\Models\Player;
use Illuminate\Console\Command;

class AddPlayersToLeague extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:add-players-to-league {league} {players}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wants a league id and a JSON player id list, adds the id-s to the list';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $playerIds = json_decode($this->argument('players'));
        $league = League::find($this->argument('league'));
        foreach($playerIds as $playerId) {
            $league->players()->attach($playerId);
        }
    }
}
