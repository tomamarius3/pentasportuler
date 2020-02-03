<?php

namespace App\Console\Commands;

use App\Models\Player;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import-players {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the players located in the database/imports';

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
        try {
            $file = fopen(
                Storage::disk('local')->path('imports/' . $this->argument('filename')),
                'r'
            );
            $keys = fgetcsv($file);
            $totalPlayers = 0;
            while($item = fgetcsv($file)) {
                $totalPlayers++;
                $player = [];
                foreach($item as $key => $string) {
                    $player[$keys[$key]] = $string;
                }
                Player::create($player);
            }
            $this->info("Successfully added {$totalPlayers} players to the database!");
        } catch(Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
