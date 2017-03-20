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
        $poli_umum = ['name' => 'poli_umum', 'display_name' => 'Poli Umum', 'description' => 'Penata Jasa Poli Umum'];
        $poli_anak = ['name' => 'poli_anak', 'display_name' => 'Poli Anak', 'description' => 'Penata Jasa Poli Anak'];
        $kasirRole = ['name' => 'kasir', 'display_name' => 'Kasir', 'description' => 'Kasir'];
        $apotek = ['name' => 'apotek', 'display_name' => 'Apotek', 'description' => 'Apotek'];

        \Illuminate\Support\Facades\DB::table('roles')->insert([$adminRole, $loketRole, $poli_umum, $poli_anak ,$kasirRole, $apotek ]);
    }
}
