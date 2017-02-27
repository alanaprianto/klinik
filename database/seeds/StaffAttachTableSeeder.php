<?php

use Illuminate\Database\Seeder;

class StaffAttachTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alan = \App\StaffPersonnel::where('nik', '11111')->first();
        $syahril = \App\StaffPersonnel::where('nik', '22222')->first();
        $lucky = \App\StaffPersonnel::where('nik', '33333')->first();


        \App\StaffPosition::create(['name' => 'Direktur', 'desc' => 'Direktur', 'staff_id' => $alan->id]);
        \App\StaffPosition::create(['name' => 'Wakil', 'desc' => 'Wakil Direktur', 'staff_id' => $syahril->id]);
        \App\StaffPosition::create(['name' => 'Staff Dokter', 'desc' => 'Dokter Biasa', 'staff_id' => $lucky->id]);

    }
}
