<?php

use Illuminate\Database\Seeder;

class StaffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_dokter = \App\StaffJob::where('name', 'Dokter')->first();
        $job_perawat = \App\StaffJob::where('name', 'Perawat')->first();
        $job_loket = \App\StaffJob::where('name', 'Loket')->first();

        $hospital  =  \App\Hospital::where('name', 'Rumah Sakit A')->first();

        $alan = ['nik' => '11111', 'full_name' => 'Alan', 'gender' => 'male', 'staff_job_id' => $job_dokter->id, 'hospital_id' => $hospital->id];
        $syahril = ['nik' => '22222', 'full_name' => 'Syahril', 'gender' => 'male', 'staff_job_id' => $job_perawat->id, 'hospital_id' => $hospital->id];
        $lucky = ['nik' => '33333', 'full_name' => 'Lucky', 'gender' => 'male' , 'staff_job_id' => $job_loket->id, 'hospital_id' => $hospital->id];

        \Illuminate\Support\Facades\DB::table('staff')->insert([$alan, $syahril, $lucky]);
    }
}
