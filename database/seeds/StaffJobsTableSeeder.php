<?php

use Illuminate\Database\Seeder;

class StaffJobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dokter = ['name' => 'Dokter', 'desc' => 'Dokter'];
        $perawat = ['name' => 'Perawat', 'desc' => 'Perawat'];
        $loket = ['name' => 'Loket', 'desc' => 'Loket'];
        $akuntansi = ['name' => 'Akuntansi', 'desc' => 'Akuntansi'];

        \Illuminate\Support\Facades\DB::table('staff_jobs')->insert([$dokter, $perawat, $loket, $akuntansi]);

    }

}
