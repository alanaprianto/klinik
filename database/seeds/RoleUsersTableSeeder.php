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
        $poli_anak = \App\User::where('username', 'poli_anak')->first();
        $kasir = \App\User::where('username', 'kasir')->first();
        $apotek = \App\User::where('username', 'apotek')->first();

        $admin_role = \App\Role::where('name', 'admin')->first();
        $loket_role = \App\Role::where('name', 'loket')->first();
        $poli_umum_role = \App\Role::where('name', 'poli_umum')->first();
        $poli_anak_role = \App\Role::where('name', 'poli_anak')->first();
        $kasir_role = \App\Role::where('name', 'kasir')->first();
        $apotek_role = \App\Role::where('name', 'apotek')->first();


        $admin->attachRole($admin_role);
        $loket->attachRole($loket_role);
        $poli_umum->attachRole($poli_umum_role);
        $poli_anak->attachRole($poli_anak_role);
        $kasir->attachRole($kasir_role);
        $apotek->attachRole($apotek_role);
    }
}
