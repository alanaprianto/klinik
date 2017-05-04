<?php

use Illuminate\Database\Seeder;

class DistributorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $d1 = ['name' => 'Sukma Jaya', 'address' => 'jl. citereup kabupaten bandung', 'phone' => '0226672010'];
        $d2 = ['name' => 'Prima Sentosa', 'address' => 'jl. cikapundung bandung', 'phone' => '0226652121'];

        \Illuminate\Support\Facades\DB::table('distributors')->insert([$d1, $d2]);

    }
}
