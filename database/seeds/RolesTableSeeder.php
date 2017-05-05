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
        $admin_role = ['name' => 'admin', 'display_name' => 'Admin', 'description' => 'Administrator'];
        $loket_role = ['name' => 'loket', 'display_name' => 'Loket', 'description' => 'Loket'];
        $admin_loket_role = ['name' => 'admin_loket', 'display_name' => 'Admin Loket', 'description' => 'Loket'];
        $poli_umum = ['name' => 'poli_umum', 'display_name' => 'Poli Umum', 'description' => 'Penata Jasa Poli Umum'];
        $admin_poli_umum = ['name' => 'admin_poli_umum', 'display_name' => 'Admin Poli Umum', 'description' => 'Penata Jasa Poli Umum'];
        $poli_anak = ['name' => 'poli_anak', 'display_name' => 'Poli Anak', 'description' => 'Penata Jasa Poli Anak'];
        $admin_poli_anak = ['name' => 'admin_poli_anak', 'display_name' => 'Admin Poli Anak', 'description' => 'Penata Jasa Poli Anak'];
        $kasir_role = ['name' => 'kasir', 'display_name' => 'Kasir', 'description' => 'Kasir'];
        $admin_kasir_role = ['name' => 'admin_kasir', 'display_name' => 'Admin Kasir', 'description' => 'Kasir'];
        $apotek = ['name' => 'apotek', 'display_name' => 'Apotek', 'description' => 'Apotek'];
        $admin_apotek = ['name' => 'admin_apotek', 'display_name' => 'Admin Apotek', 'description' => 'Apotek'];
        $penata_jasa = ['name' => 'penata_jasa', 'display_name' => 'Penata Jasa', 'description' => 'Penata Jasa Role'];
        $poli_gigi = ['name' => 'poli_gigi', 'display_name' => 'Poli Gigi', 'description' => 'Poli Gigi Role'];

        \Illuminate\Support\Facades\DB::table('roles')->insert([$admin_role, $loket_role, $admin_loket_role, $poli_umum, $admin_poli_umum, $poli_anak, $admin_poli_anak, $kasir_role, $admin_kasir_role, $apotek, $admin_apotek, $penata_jasa, $poli_gigi]);
    }
}
