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
        /*name, purchase_price, type, sediaan, price, */
        $inventories = [
            ["Amoksan Tab 500mg", "3800", "pharmacy", "pcs", "2"],
            ["Samol Tab 500mg", "750", "pharmacy", "pcs", "2"],
            ["Telfast OD", "8500", "pharmacy", "pcs", "2"],
            ["Amoxan dry syr", "25400", "pharmacy", "pcs", "2"],
            ["Arcamox 500mg", "3600", "pharmacy", "pcs", "2"],
            ["Baquinor F", "15400", "pharmacy", "pcs", "2"],
            ["Benoson CR 15Gr", "17200", "pharmacy", "pcs", "2"],
            ["Benoson CR 5Gr", "8000", "pharmacy", "pcs", "2"],
            ["Binotal 1000mg", "7100", "pharmacy", "pcs", "2"],
            ["Binotal 500mg", "4200", "pharmacy", "pcs", "2"],
            ["Biothicol 500mg", "4100", "pharmacy", "pcs", "2"],
            ["Bufacort N cream", "4150", "pharmacy", "pcs", "2"],
            ["Cefat 500mg", "12250", "pharmacy", "pcs", "2"],
            ["Cefat Forte Syr", "81500", "pharmacy", "pcs", "2"],
            ["Clabat 500mg", "13750", "pharmacy", "pcs", "2"],
            ["Clanexi Caps", "13250", "pharmacy", "pcs", "2"],
            ["Climadan 300mg", "8650", "pharmacy", "pcs", "2"],
            ["Co amoxiclav 625mg", "6100", "pharmacy", "pcs", "2"],
            ["Cravox 500mg", "31650", "pharmacy", "pcs", "2"],
            ["Elocon Cr 5gr", "56700", "pharmacy", "pcs", "2"],
            ["Flagy F", "6500", "pharmacy", "pcs", "2"],
            ["Flagystatin Supp", "15900", "pharmacy", "pcs", "2"],
            ["Gentamycin Inj ", "6000", "pharmacy", "pcs", "2"],
            ["Interflox 500mg", "14400", "pharmacy", "pcs", "2"],
            ["Kalmoxcilin 500mg", "2600", "pharmacy", "pcs", "2"],
            ["Sanprima forte tab", "2200", "pharmacy", "pcs", "2"],
            ["Sterptomycin 1G Inj", "6400", "pharmacy", "pcs", "2"],
            ["Tarivid 400gr", "16750", "pharmacy", "pcs", "2"],
            ["Lactamox 500mg", "1300", "pharmacy", "pcs", "2"],
            ["Kanamycin Inj 1gr", "11300", "pharmacy", "pcs", "2"]
        ];

        foreach ($inventories as $inventory) {
            \Illuminate\Support\Facades\DB::table('inventories')->insert([
                'name' => $inventory[0],
                'purchase_price' => $inventory[1],
                'type' => $inventory[2],
                'sediaan' => $inventory[3],
                'inventory_category_id' => $inventory[4]
            ]);
        }

        $i1 = \App\Inventory::find(1);
        $i2 = \App\Inventory::find(2);
        $i3 = \App\Inventory::find(3);
        $i4 = \App\Inventory::find(4);
        $i5 = \App\Inventory::find(5);
        $i6 = \App\Inventory::find(6);
        $i7 = \App\Inventory::find(7);
        $i8 = \App\Inventory::find(8);
        $i9 = \App\Inventory::find(9);
        $i10 = \App\Inventory::find(10);
        $i11 = \App\Inventory::find(11);
        $i12 = \App\Inventory::find(12);
        $i13 = \App\Inventory::find(13);
        $i14 = \App\Inventory::find(14);
        $i15 = \App\Inventory::find(15);
        $i16 = \App\Inventory::find(16);
        $i17 = \App\Inventory::find(17);
        $i18 = \App\Inventory::find(18);
        $i19 = \App\Inventory::find(19);
        $i20 = \App\Inventory::find(20);
        $i21 = \App\Inventory::find(21);
        $i22 = \App\Inventory::find(22);
        $i23 = \App\Inventory::find(23);
        $i24 = \App\Inventory::find(24);
        $i25 = \App\Inventory::find(25);
        $i26 = \App\Inventory::find(26);
        $i27 = \App\Inventory::find(27);
        $i28 = \App\Inventory::find(28);
        $i29 = \App\Inventory::find(29);
        $i30 = \App\Inventory::find(30);

        $i1->depos()->sync([1]);
        $i2->depos()->sync([1]);
        $i3->depos()->sync([1]);
        $i4->depos()->sync([1]);
        $i5->depos()->sync([1]);
        $i6->depos()->sync([1]);
        $i7->depos()->sync([1]);
        $i8->depos()->sync([1]);
        $i9->depos()->sync([1]);
        $i10->depos()->sync([1]);
        $i11->depos()->sync([1]);
        $i12->depos()->sync([1]);
        $i13->depos()->sync([1]);
        $i14->depos()->sync([1]);
        $i15->depos()->sync([1]);
        $i16->depos()->sync([1]);
        $i17->depos()->sync([1]);
        $i18->depos()->sync([1]);
        $i19->depos()->sync([1]);
        $i20->depos()->sync([1]);
        $i21->depos()->sync([1]);
        $i22->depos()->sync([1]);
        $i23->depos()->sync([1]);
        $i24->depos()->sync([1]);
        $i25->depos()->sync([1]);
        $i26->depos()->sync([1]);
        $i27->depos()->sync([1]);
        $i28->depos()->sync([1]);
        $i29->depos()->sync([1]);
        $i30->depos()->sync([1]);
    }
}
