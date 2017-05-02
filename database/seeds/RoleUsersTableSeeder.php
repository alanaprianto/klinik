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
        $admin_loket = \App\User::where('username', 'admin_loket')->first();
        $poli_umum = \App\User::where('username', 'poli_umum')->first();
        $admin_poli_umum = \App\User::where('username', 'admin_poli_umum')->first();
        $poli_anak = \App\User::where('username', 'poli_anak')->first();
        $admin_poli_anak = \App\User::where('username', 'admin_poli_anak')->first();
        $kasir = \App\User::where('username', 'kasir')->first();
        $admin_kasir = \App\User::where('username', 'admin_kasir')->first();
        $apotek = \App\User::where('username', 'apotek')->first();
        $admin_apotek = \App\User::where('username', 'admin_apotek')->first();
        $penata_jasa = \App\User::where('username', 'penata_jasa')->first();

        $admin_role = \App\Role::where('name', 'admin')->first();
        $loket_role = \App\Role::where('name', 'loket')->first();
        $admin_loket_role = \App\Role::where('name', 'admin_loket')->first();
        $poli_umum_role = \App\Role::where('name', 'poli_umum')->first();
        $admin_poli_umum_role = \App\Role::where('name', 'admin_poli_umum')->first();
        $poli_anak_role = \App\Role::where('name', 'poli_anak')->first();
        $admin_poli_anak_role = \App\Role::where('name', 'admin_poli_anak')->first();
        $kasir_role = \App\Role::where('name', 'kasir')->first();
        $admin_kasir_role = \App\Role::where('name', 'admin_kasir')->first();
        $apotek_role = \App\Role::where('name', 'apotek')->first();
        $admin_apotek_role = \App\Role::where('name', 'admin_apotek')->first();
        $penata_jasa_role = \App\Role::where('name', 'penata_jasa')->first();


        $admin->attachRole($admin_role);
        $loket->attachRole($loket_role);
        $poli_umum->attachRole($poli_umum_role);
        $poli_anak->attachRole($poli_anak_role);
        $kasir->attachRole($kasir_role);
        $apotek->attachRole($apotek_role);
        $penata_jasa->attachRole($penata_jasa_role);

        $admin_loket->attachRoles([$loket_role->id, $admin_loket_role->id]);
        $admin_poli_umum->attachRoles([$poli_umum_role->id, $admin_poli_umum_role->id]);
        $admin_poli_anak->attachRoles([$poli_anak_role->id, $admin_poli_anak_role->id]);
        $admin_kasir->attachRoles([$kasir_role->$kasir_role, $admin_kasir_role->id]);
        $admin_apotek->attachRoles([$apotek_role->id, $admin_apotek_role->id]);
    }
}
