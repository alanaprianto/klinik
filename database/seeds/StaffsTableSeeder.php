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
        $user_1 = \App\User::where('name', 'Admin')->first();
        $user_2 = \App\User::where('name', 'Loket')->first();
        $user_3 = \App\User::where('name', 'poli_umum')->first();
        $user_4 = \App\User::where('name', 'poli_anak')->first();
        $user_5 = \App\User::where('name', 'Kasir')->first();

        $job_dokter = \App\StaffJob::where('name', 'Dokter')->first();
        $hospital  =  \App\Hospital::where('name', 'Rumah Sakit A')->first();


        $alan = ['nik' => '11111', 'full_name' => 'Alan', 'gender' => 'male', 'staff_job_id' => $job_dokter->id, 'hospital_id' => $hospital->id, 'user_id' => $user_1->id];
        $syahril = ['nik' => '22222', 'full_name' => 'Syahril', 'gender' => 'male', 'staff_job_id' => $job_dokter->id, 'hospital_id' => $hospital->id, 'user_id' => $user_2->id];
        $lucky = ['nik' => '33333', 'full_name' => 'Lucky', 'gender' => 'male' , 'staff_job_id' => $job_dokter->id, 'hospital_id' => $hospital->id, 'user_id' => $user_3->id];
        $user_4 = ['nik' => '4444', 'full_name' => 'Empat', 'gender' => 'male' , 'staff_job_id' => $job_dokter->id, 'hospital_id' => $hospital->id, 'user_id' => $user_4->id];
        $user_5 = ['nik' => '5555', 'full_name' => 'Lima', 'gender' => 'male' , 'staff_job_id' => $job_dokter->id, 'hospital_id' => $hospital->id, 'user_id' => $user_5->id];

        \Illuminate\Support\Facades\DB::table('staff')->insert([$alan, $syahril, $lucky, $user_4, $user_5]);
    }
}
