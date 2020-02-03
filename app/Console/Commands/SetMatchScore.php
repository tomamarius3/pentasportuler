<?php

namespace App\Console\Commands;

use App\Models\Match;
use Illuminate\Console\Command;

class SetMatchScore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:set-match-score {matchId} {homeScore} {awayScore}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets the score for the given match id';

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
     */
    public function handle()
    {
        $match = Match::find($this->argument('matchId'));
        $match->home_score = $this->argument('homeScore');
        $match->away_score = $this->argument('awayScore');
        $match->save();
    }
}
