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
        $alan = \App\Staff::where('nik', '11111')->first();
        $syahril = \App\Staff::where('nik', '22222')->first();
        $lucky = \App\Staff::where('nik', '33333')->first();
        $four = \App\Staff::where('nik', '4444')->first();
        $fifth = \App\Staff::where('nik', '5555')->first();

        \Illuminate\Support\Facades\DB::table('doctor_services')->insert(['cost' => 100000, 'allowance' => 1000000, 'staff_id' => $alan->id]);
        \Illuminate\Support\Facades\DB::table('doctor_services')->insert(['cost' => 110000, 'allowance' => 1100000, 'staff_id' => $syahril->id]);
        \Illuminate\Support\Facades\DB::table('doctor_services')->insert(['cost' => 120000, 'allowance' => 1200000, 'staff_id' => $lucky->id]);
        \Illuminate\Support\Facades\DB::table('doctor_services')->insert(['cost' => 130000, 'allowance' => 1300000, 'staff_id' => $four->id]);
        \Illuminate\Support\Facades\DB::table('doctor_services')->insert(['cost' => 140000, 'allowance' => 1400000, 'staff_id' => $fifth->id]);


        \Illuminate\Support\Facades\DB::table('staff_positions')->insert(['name' => 'Direktur', 'desc' => 'Direktur', 'staff_id' => $alan->id]);
        \Illuminate\Support\Facades\DB::table('staff_positions')->insert(['name' => 'Wakil', 'desc' => 'Wakil Direktur', 'staff_id' => $syahril->id]);
        \Illuminate\Support\Facades\DB::table('staff_positions')->insert(['name' => 'Staff Dokter', 'desc' => 'Dokter Biasa', 'staff_id' => $lucky->id]);
        \Illuminate\Support\Facades\DB::table('staff_positions')->insert(['name' => 'Staff Dokter', 'desc' => 'Dokter Biasa', 'staff_id' => $four->id]);
        \Illuminate\Support\Facades\DB::table('staff_positions')->insert(['name' => 'Staff Dokter', 'desc' => 'Dokter Biasa', 'staff_id' => $fifth->id]);

    }
}
