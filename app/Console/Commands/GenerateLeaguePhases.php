<?php

namespace App\Console\Commands;

use App\Models\League;
use Illuminate\Console\Command;

class GenerateLeaguePhases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:generate-phases {league}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all phases for a league';

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
        /** @var League $league */
        $league = League::find($this->argument('league'));
        if($league->phases->count() == 0) {
            $league->generatePhases();
        }
    }
}
