<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = ['name' => 'admin', 'display_name' => 'Admin', 'description' => 'Administrator'];
        $loketRole = ['name' => 'loket', 'display_name' => 'Loket', 'description' => 'Loket'];
        $penataJasaRole = ['name' => 'penata-jasa', 'display_name' => 'Penata Jasa', 'description' => 'Penata Jasa'];
        $kasirRole = ['name' => 'kasir', 'display_name' => 'Kasir', 'description' => 'Kasih'];

        \Illuminate\Support\Facades\DB::table('roles')->insert([$adminRole, $loketRole, $penataJasaRole, $kasirRole ]);
    }
}
