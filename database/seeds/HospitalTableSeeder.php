<?php

use Illuminate\Database\Seeder;

class HospitalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hospital = ['name' => 'Rumah Sakit A', 'address' => 'Jalan Dimana Saja'];
        \Illuminate\Support\Facades\DB::table('hospitals')->insert([$hospital]);
    }
}
