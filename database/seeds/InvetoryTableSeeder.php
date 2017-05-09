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
          ['verban besar', 'pharmacy', 'pcs', 1],
          ['verban sedang', 'pharmacy', 'pcs', 2],
          ['verban kecil', 'pharmacy', 'pcs', 3],
          ['verban besar', 'pharmacy', 'pcs', 1],
          ['cairan infus', 'pharmacy', 'pcs', 2],
        ];

        foreach ($inventories as $inventory) {
            \Illuminate\Support\Facades\DB::table('inventories')->insert(['name' => $inventory[0], 'type' => $inventory[1], 'sediaan' => $inventory[2], 'inventory_category_id' => $inventory[3]]);
        }

        $i1 = \App\Inventory::where('name', 'verban besar')->first();
        $i2 = \App\Inventory::where('name', 'verban sedang')->first();
        $i3 = \App\Inventory::where('name', 'verban kecil')->first();
        $i4 = \App\Inventory::where('name', 'verban besar')->first();
        $i5 = \App\Inventory::where('name', 'cairan infus')->first();

        $i1->depos()->sync([1]);
        $i2->depos()->sync([1]);
        $i3->depos()->sync([1]);
        $i4->depos()->sync([1]);
        $i5->depos()->sync([1]);
    }
}
