<?php

use Illuminate\Database\Seeder;

class InventoryCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ic1 = ['name' => 'Barang Berbahaya', 'desc' => 'Barang berbahaya mudah terinfeksi dll'];
        $ic2 = ['name' => 'Barang Normal', 'desc' => 'Barang tidak tidak mudah terinfeksi'];
        $ic3 = ['name' => 'Barang Langka', 'desc' => 'Barang dengen stock terbatas'];

        \Illuminate\Support\Facades\DB::table('inventory_categories')->insert([$ic1, $ic2, $ic3]);
    }
}
