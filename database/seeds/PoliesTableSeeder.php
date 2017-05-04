<?php

use Illuminate\Database\Seeder;

class PoliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poli_umum = ['name' => 'Poli Umum', 'desc' => 'Poli Umum', 'icon' => 'fa-plus-square'];
        $poli_anak = ['name' => 'Poli Anak', 'desc' => 'Poli Anak', 'icon' => 'fa-child'];
        $poli_gigi = ['name' => 'Poli Gigi', 'desc' => 'Poli Gigi', 'icon' => 'fa-stethoscope'];
/*        $poli_kebidanan = ['name' => 'Poli Kebidanan', 'desc' => 'Poli Kebidanan'];
        $poli_penyakit_dalam = ['name' => 'Poli Spesialis Penyakit Dalam', 'desc' => 'Poli Spesialis Penyakit Dalam'];
        $poli_mata = ['name' => 'Poli Mata', 'desc' => 'Poli Mata'];
        $poli_tht = ['name' => 'Poli THT', 'desc' => 'Poli THT'];
        $poli_bedah = ['name' => 'Poli Bedah', 'desc' => 'Poli Bedah'];*/

        \Illuminate\Support\Facades\DB::table('polies')->insert([$poli_umum, $poli_anak, $poli_gigi]);

    }
}
