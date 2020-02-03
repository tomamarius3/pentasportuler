<?php

namespace App\Console\Commands;

use App\Models\League;
use Illuminate\Console\Command;

class CreateLeague extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-league {edition_id} {rank} {name} {slug} {promotions} {demotions}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Editions have many leagues, this one creates a league, all arguments are required';

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
        $fillableArguments = $this->arguments();
        unset($fillableArguments['command']);
        League::create(
            $fillableArguments
        );
        $this->info("Created the {$this->argument('name')} league!");
    }
}
