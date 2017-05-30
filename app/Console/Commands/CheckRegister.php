<?php

namespace App\Console\Commands;

use App\Register;
use Illuminate\Console\Command;

class CheckRegister extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change status register if still opened';

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
        $registers = Register::where('type', 0)->where('status', 1)->get();
        foreach ($registers as $register){
            $register->update([
                'status' => 2
            ]);
        }
    }
}
