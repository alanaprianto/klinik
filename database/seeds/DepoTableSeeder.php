<?php

use Illuminate\Database\Seeder;

class DepoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poly_umum = \App\Poly::where('name', 'Poli Umum')->first();
        $poly_anak = \App\Poly::where('name', 'Poli Anak')->first();
        $poly_gigi = \App\Poly::where('name', 'Poli Gigi')->first();

        $parent_depo = \App\Depo::create([
            'name' => 'primary_depo',
            'desc' => 'depo rumah sakit utama',
            'location' => 'timur rumah sakit'
        ]);
        
        $poly_umum->depo()->create([
            'name' => 'depo_poli_umum',
            'desc' => 'Depo Poli umum ',
            'location' => 'barat rumah sakit',
            'parent_id' => $parent_depo->id
        ]);
        $poly_anak->depo()->create([
            'name' => 'depo_poli_anak',
            'desc' => 'Depo Poli Anak ',
            'location' => 'timur rumah sakit',
            'parent_id' => $parent_depo->id
        ]);
        $poly_gigi->depo()->create([
            'name' => 'depo_poli_gigi',
            'desc' => 'Depo poli gigi ',
            'location' => 'barat rumah sakit',
            'parent_id' => $parent_depo->id
        ]);
    }
}
