<?php

namespace App\Console\Commands;

use App\Models\Edition;
use Illuminate\Console\Command;

class CreateEdition extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-edition {sport_id} {number} {active}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an edition for the Sport (Table Tennis is 1)';

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
        Edition::create(
            $this->arguments()
        );
        $this->info("Created edition #{$this->argument('number')}!");
    }
}
