<?php

use Illuminate\Database\Seeder;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::where('username', 'admin')->first();
        $loket = \App\User::where('username', 'loket')->first();
        $poli_umum = \App\User::where('username', 'poli_umum')->first();
        $kasir = \App\User::where('username', 'kasir')->first();

        $admin_role = \App\Role::where('name', 'admin')->first();
        $loket_role = \App\Role::where('name', 'loket')->first();
        $penata_jasa_role = \App\Role::where('name', 'penata-jasa')->first();
        $kasir_role = \App\Role::where('name', 'kasir')->first();


        $admin->attachRole($admin_role);
        $loket->attachRole($loket_role);
        $poli_umum->attachRole($penata_jasa_role);
        $kasir->attachRole($kasir_role);
    }
}
