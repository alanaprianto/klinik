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
        $services = [
            ["Ganti verban besar",45000  ],
            ["Ganti verban sedang",30000  ],
            ["Ganti verban kecil",15000  ],
            ["Jahit/hecting 1 - 5x",20000  ],
            ["Jahit/hecting 5 - 10x",40000  ],
            ["Aff hecting > 10x",50000  ],
            ["Insisi abses besar",84000  ],
            ["Insisi abses sedang",60000  ],
            ["Insisi abses kecil ",36000  ],
            ["EKG",50000  ],
            ["Nebulizer",100000  ],
            ["Pemasangan infus dewasa ",35000  ],
            ["pemasangan infus anak-anak",35000  ],
            ["Pemasangan NGT",40000  ],
            ["Pemasangan kateter uretra",40000  ],
            ["Pemasangan splak kecil",30000  ],
            ["Pemasangan splak besar",30000  ],
            ["Resusitasi jantung paru",60000  ],
            ["Ekstirpasi benda asing/corpal",40000  ],
            ["Perawatan luka bakar besar",84000  ],
            ["Parawatan luka bakar sedang",60000  ],
            ["Perawatan luka bakar kecil",36000  ],
            ["Cross incisi",35000  ],
            ["Aspirasi Hemarthrosis",80000  ],
            ["Corpus Alienum (THT)",70000  ],
            ["Irigasi mata",70000  ],
            ["Irigasi telinga ",70000  ],
            ["Tampon telinga",70000  ],
            ["Spoeling CAE (Satu telinga)",70000  ],
            ["Ekstirpasi Korpal CAE",75000  ],
            ["Pasang IUD",100000  ],
            ["Lepas IUD",75000  ],
            ["Spirometri / VO2 Max",95000  ],
            ["Fungsi Efusi Pleura",570000  ],
            ["Incisi Fistel pre aurikuler",250000  ],
            ["Incisi abses retro aurikuler",250000  ],
            ["Incisi abses Septal",300000  ],
            ["Incisi abses peritonsilar",500000  ],
            ["Reposisi fraktur nasal",700000  ],
            ["Endoskopi hidung dan faring",250000  ]
        ];

        foreach ($services as $service) {
            \Illuminate\Support\Facades\DB::table('services')->insert(['name' => $service[0], 'cost' => $service[1]]);
        }
    }
}
