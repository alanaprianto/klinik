<?php

use Illuminate\Database\Seeder;

class PermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $p1 = ['name' => 'loket', 'display_name' => 'Loket', 'description' => 'Loket Permission', 'parent_id' => null];
        $p2 = ['name' => 'kasir', 'display_name' => 'Kasir', 'description' => 'Kasir Permission', 'parent_id' => null];
        $p3 = ['name' => 'penata_jasa', 'display_name' => 'Penata Jasa', 'description' => 'Penata Jasa Permission', 'parent_id' => null];
        $p4 = ['name' => 'apotek', 'display_name' => 'Apotek', 'description' => 'Apotek Permission', 'parent_id' => null];

        \Illuminate\Support\Facades\DB::table('permissions')->insert([$p1, $p2, $p3, $p4]);

        $penata_jasa = \App\Permission::where('name', 'penata_jasa')->first();


        $p_umum = ['name' => 'poly_umum', 'display_name' => 'Poli Umum', 'description' => 'Poli Umum permission', 'parent_id' => $penata_jasa->id];
        $p_anak = ['name' => 'poli_anak', 'display_name' => 'Poli Anak', 'description' => 'Poli Anak Permission', 'parent_id' => $penata_jasa->id];
        $p_gigi = ['name' => 'poli_gigi', 'display_name' => 'Poli Gigi', 'description' => 'Poli Gigi Permission', 'parent_id' => $penata_jasa->id];


        \Illuminate\Support\Facades\DB::table('permissions')->insert([$p_umum, $p_anak, $p_gigi]);
    }
}
