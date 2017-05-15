<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c1 = ['name' => 'category_1', 'display_name'  => 'Kategori 1','desc' => 'category ke 1'];
        $c2 = ['name' => 'category_2', 'display_name'  => 'Kategori 2','desc' => 'category ke 2'];
        $c3 = ['name' => 'category_3', 'display_name'  => 'Kategori 3','desc' => 'category ke 3'];
        \Illuminate\Support\Facades\DB::table('category_services')->insert([$c1, $c2, $c3]);

        $services = [
            ["Ganti verban besar",45000, 1],
            ["Ganti verban sedang",30000, 1],
            ["Ganti verban kecil",15000, 1],
            ["Jahit/hecting 1 - 5x",20000, 2],
            ["Jahit/hecting 5 - 10x",40000, 2],
            ["Aff hecting > 10x",50000, 2],
            ["Insisi abses besar",84000, 3],
            ["Insisi abses sedang",60000, 3],
            ["Insisi abses kecil ",36000, 3],
            ["EKG",50000, 1],
            ["Nebulizer",100000, 1],
            ["Pemasangan infus dewasa ",35000, 2],
            ["pemasangan infus anak-anak",35000, 2],
            ["Pemasangan NGT",40000, 2],
            ["Pemasangan kateter uretra",40000, 3],
            ["Pemasangan splak kecil",30000, 3],
            ["Pemasangan splak besar",30000, 3],
            ["Resusitasi jantung paru",60000, 1],
            ["Ekstirpasi benda asing/corpal",40000, 1],
            ["Perawatan luka bakar besar",84000, 1],
            ["Parawatan luka bakar sedang",60000, 1],
            ["Perawatan luka bakar kecil",36000, 1],
            ["Cross incisi",35000, 2],
            ["Aspirasi Hemarthrosis",80000, 2],
            ["Corpus Alienum (THT)",70000, 2],
            ["Irigasi mata",70000, 3],
            ["Irigasi telinga ",70000, 3],
            ["Tampon telinga",70000, 3],
            ["Spoeling CAE (Satu telinga)",70000, 1],
            ["Ekstirpasi Korpal CAE",75000, 1],
            ["Pasang IUD",100000, 1],
            ["Lepas IUD",75000, 2],
            ["Spirometri / VO2 Max",95000, 2],
            ["Fungsi Efusi Pleura",570000, 2],
            ["Incisi Fistel pre aurikuler",250000, 3],
            ["Incisi abses retro aurikuler",250000, 3],
            ["Incisi abses Septal",300000, 3],
            ["Incisi abses peritonsilar",500000, 1],
            ["Reposisi fraktur nasal",700000, 2],
            ["Endoskopi hidung dan faring",250000, 3]
        ];

        foreach ($services as $service) {
            \Illuminate\Support\Facades\DB::table('services')->insert(['name' => $service[0], 'cost' => $service[1], 'category_service_id' => $service[2]]);
        }
    }
}
