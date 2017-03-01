<?php

use Illuminate\Database\Seeder;

class DoctorPoliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poly_1 = \App\Poly::where('name', 'Poli Umum')->first();
        $poly_2 = \App\Poly::where('name', 'Poli Kebidanan')->first();
        $poly_3 = \App\Poly::where('name', 'Poli Anak')->first();

        $doctor_1 = \App\Staff::where('full_name', 'Alan')->first();
        $doctor_2 = \App\Staff::where('full_name', 'Syahril')->first();
        $doctor_3 = \App\Staff::where('full_name', 'Lucky')->first();


        $poly_1->doctors()->attach($doctor_1->id);
        $poly_2->doctors()->attach($doctor_2->id);
        $poly_3->doctors()->attach($doctor_3->id);
    }
}
