<?php

namespace App\Console\Commands;

use App\Models\Sport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the commands necessary to install the leagues';

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
        Artisan::call('migrate');
        if(Sport::count() == 0) {
            Sport::insert([
                'name' => 'Tenis de masa'
            ]);
            Artisan::call('command:create-edition 1 1 1');
            Artisan::call('command:create-league 1 1 "Liga 1" liga-1 0 2');
            Artisan::call('command:create-league 1 2 "Liga 2 A" liga-2-a 1 2');
            Artisan::call('command:create-league 1 2 "Liga 2 B" liga-2-b 1 2');
            Artisan::call('command:create-league 1 3 "Liga 3 A" liga-1 4 0');
            Artisan::call('command:create-league 1 3 "Liga 3 B" liga-1 4 0');
            Artisan::call('command:import-players players.csv');
            Artisan::call('command:add-players-to-league 1 [1,2,3,4,5,6,7,8,9,10,11,12]');
            Artisan::call('command:add-players-to-league 2 [13,14,15,16,17,18,19,20,21,22,23,24]');
            Artisan::call('command:add-players-to-league 3 [25,26,27,28,29,30,31,32,33,34,35,36]');
            Artisan::call('command:add-players-to-league 4 [37,38,39,40,41,42,43,44,45,46]');
            Artisan::call('command:add-players-to-league 5 [47,48,49,50,51,52,53,54,55]');
            Artisan::call('command:generate-phases 1');
            Artisan::call('command:generate-phases 2');
            Artisan::call('command:generate-phases 3');
            Artisan::call('command:generate-phases 4');
            Artisan::call('command:generate-phases 5');
        }
    }
}
