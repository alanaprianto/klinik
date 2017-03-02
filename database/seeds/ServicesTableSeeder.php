<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pasang_infus = ['name' => 'Pasang Infus', 'cost' => '60000'];
        $lepas_infus = ['name' => 'Lepas Infus', 'cost' => '70000'];

        \Illuminate\Support\Facades\DB::table('services')->insert([$pasang_infus, $lepas_infus]);
    }
}
