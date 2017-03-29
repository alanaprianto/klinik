<?php

namespace App\Console\Commands;

use App\Kiosk;
use Illuminate\Console\Command;

class ClearQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'truncate:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Queue list Method';

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
        Kiosk::truncate();
    }
}
