<?php

use Illuminate\Database\Seeder;

class InvetoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*code, name, category, type, explain, sediaan, price, */
        $inventories = [
          ['verban besar', 'pharmacy', 'pcs', '5000', 1],
          ['verban sedang', 'pharmacy', 'pcs', '4000', 2],
          ['verban kecil', 'pharmacy', 'pcs', '3000', 3],
          ['verban besar', 'pharmacy', 'pcs', '5000', 1],
          ['cairan infus', 'pharmacy', 'pcs', '30000', 2],
        ];

        foreach ($inventories as $inventory) {
            \Illuminate\Support\Facades\DB::table('inventories')->insert(['name' => $inventory[0], 'type' => $inventory[1], 'sediaan' => $inventory[2], 'price' => $inventory[3], 'inventory_category_id' => $inventory[4]]);
        }
    }
}
