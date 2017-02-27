<?php

function getProvinceCities()
{
    return [
        "ACEH" => ["Kota Banda Aceh", "Kota Sabang", "Aceh Besar", "Pidie", "Aceh Utara", "Aceh Tengah", "Aceh Barat", "Aceh Selatan", "Aceh Timur", "Aceh Tenggara", "Simeule", "Aceh Singkil", "Bireuen", "Kota Lhokseumawe", "Aceh Tamiang", "Kota Langsa", "Aceh Barat Daya", "Gayo Lues", "Aceh Jaya", "Kota Subulussalam", "Nagan Raya", "Pidie Jaya", "Bener Meriah"],
        "SUMATERA UTARA" => ["Kota Medan", "Kota Binjai", "Kota Tanjung Balai", "Kota Tebing Tinggi", "Kota Pematang Siantar", "Kota Sibolga", "Kota Padang Sidempuan", "Deli Serdang", "Langkat", "Karo", "Simalungun", "Asahan", "Labuhan Batu", "Tapanuli Tengah", "Tapanuli Utara", "Tapanuli Selatan", "Nias", "Dairi", "Toba Samosir", "Mandailing Natal", "Serdang Bedagai", "Nias Selatan", "Pakpak Bharat", "Humbang Hasundutan", "Samosir", "Batu Bara", "Labuhanbatu Selatan", "Padang Lawas", "Labuhanbatu Utara", "Padang Lawas Utara"],
        "SUMATERA BARAT" => ["Kota Padang", "Kota Bukittinggi", "Kota Payakumbuh", "Kota Padang Panjang", "Kota Solok", "Kota Sawah Lunto", "Pasaman", "Agam", "Lima Puluh Koto", "Tanah Datar", "Solok", "Sawahlunto/Sijunjung", "Padang Pariaman", "Pesisir Selatan", "Solok Selatan", "Pasaman Barat", "Kota Pariaman", "Dharmas Raya", "Kepulauan Mentawai"],
        "RIAU" => ["Kota Pekanbaru", "Kota Dumai", "Bengkalis", "Kampar", "Indragiri Hulu", "Indragiri Hilir", "Kuantan Singingi", "Pelalawan", "Rokan Hilir", "Rokan Hulu", "Siak", "Kepulauan Meranti"],
        "JAMBI" => ["Kota Jambi", "Batang Hari", "Bungo", "Tebo", "Kerinci", "Merangin", "Sarolangun", "Tanjung Jabung Barat", "Tanjung Jabung Timur", "Muaro Jambi"],
        "BENGKULU" => ["Kota Bengkulu", "Bengkulu Utara", "Bengkulu Selatan", "Rejang Lebong", "Muko-muko", "Seluma", "Kaur", "Lebong", "Kepahiang", "Bengkulu Tengah"],
        "SUMATERA SELATAN" => ["Kota Palembang", "Banyuasin", "Musi Banyuasin", "Musi Rawas", "Ogan Komering Ilir", "Ogan Komering Ulu", "Muara Enim", "Lahat", "Ogan Komering Ulu Timur", "Ogan Komering Ulu Selatan", "Ogan ilir", "Kota Lubuk Linggau", "Kota Pagar Alam", "Kota Prabumulih", "Penukal Abab Lematang Ilir", "Musi Rawas Utara", "Empat Lawang"],
        "LAMPUNG" => ["Kota Bandar Lampung", "Lampung Utara", "Lampung Barat", "Lampung Tengah", "Lampung Selatan", "Kota Metro", "Tulang Bawang", "Tanggamus", "Way Kanan", "Lampung Timur", "Pesawaran", "Tulang Bawang Barat", "Mesuji", "Pringsewu"],
        "BANGKA BELITUNG" => ["Kota Pangkalpinang", "Bangka", "Belitung", "Bangka Tengah", "Bangka Barat", "Belitung Timur", "Bangka Selatan"],
        "KEPULAUAN RIAU" => ["Kota Tanjung Pinang", "Kota Batam", "Bintan", "Karimun", "Natuna", "Lingga", "Kepulauan Anambas"],
        "JAWA BARAT" => ["Kota Bandung", "Kota Bogor", "Kota Sukabumi", "Kota Cirebon", "Bekasi", "Karawang", "Purwakarta", "Subang", "Bogor", "Sukabumi", "Cianjur", "Bandung", "Garut", "Sumedang", "Tasikmalaya", "Ciamis", "Kuningan", "Cirebon", "Indramayu", "Majalengka", "Kota Bekasi", "Kota Depok", "Kota Cimahi", "Kota Tasikmalaya", "Kota Banjar", "Bandung Barat", "Pangandaran"],
        "DKI JAKARTA" => ["Jakarta Pusat", "Jakarta Barat", "Jakarta Selatan", "Jakarta Timur", "Jakarta Utara", "Kepulauan Seribu"],
        "JAWA TENGAH" => ["Kota Semarang", "Kota Tegal", "Kota Pekalongan", "Kota Salatiga", "Kota Magelang", "Kota Surakarta", "Semarang", "Kendal", "Demak", "Grobogan", "Pekalongan", "Batang", "Pemalang", "Tegal", "Brebes", "Banyumas", "Cilacap", "Banjarnegara", "Purbalingga", "Magelang", "Temanggung", "Wonosobo", "Purworejo", "Kebumen", "Pati", "Kudus", "Jepara", "Blora", "Sukoharjo", "Klaten", "Rembang", "Sragen", "Boyolali", "Karanganyar", "Wonogiri"],
        "DI YOGYAKARTA" => ["Kota Yogyakarta", "Bantul", "Sleman", "Kulon Progo", "Gunung Kidul"],
        "JAWA TIMUR" => ["Kota Surabaya", "Kota Malang", "Kota Kediri", "Kota Madiun", "Kota Blitar", "Kota Mojokerto", "Kota Pasuruan", "Kota Probolinggo", "Gresik", "Sidoarjo", "Mojokerto", "Jombang", "Bojonegoro", "Tuban", "Lamongan", "Madiun", "Magetan", "Ngawi", "Ponorogo", "Pacitan", "Kediri", "Nganjuk", "Blitar", "Tulungagung", "Trenggalek", "Malang", "Pasuruan", "Probolinggo", "Lumajang", "Bondowoso", "Situbondo", "Jember", "Banyuwangi", "Pamekasan", "Sampang", "Sumenep", "Bangkalan", "Kota Batu"],
        "BANTEN" => ["Kota Tangerang", "Kota Cilegon", "Serang", "Lebak", "Pandeglang", "Tangerang", "Kota Serang", "Kota Tangerang Selatan"],
        "KALIMANTAN BARAT" => ["Kota Pontianak", "Sambas", "Pontianak", "Sanggau", "Sintang", "Kapuas Hulu", "Ketapang", "Landak", "Bengkayang", "Melawi", "Sekadau", "Kota Singkawang", "Kayong Utara", "Kubu Raya"],
        "KALIMANTAN TENGAH" => ["Kota Palangka Raya", "Kotawaringin Barat", "Kapuas", "Kotawaringin Timur", "Barito Utara", "Barito Selatan", "Pulang Pisau", "Gunung Mas", "Sukamara", "Lamandau", "Katingan", "Seruyan", "Murung Raya", "Barito Timur"],
        "KALIMANTAN SELATAN" => ["Kota Banjarmasin", "Banjar", "Hulu Sungai Utara", "Hulu Sungai Tengah", "Hulu Sungai Selatan", "Kota Baru", "Barito Kuala", "Tapin", "Tabalong", "Tanah Laut", "Kota Banjar Baru", "Tanah Bumbu", "Balangan"],
        "KALIMANTAN TIMUR" => ["Kota Samarinda", "Kota Balikpapan", "Kutai Kartanegara", "Berau", "Paser", "Kota Bontang", "Kutai Timur", "Kutai Barat", "Penajam Paser Utara", "Mahakam Ulu"],
        "Provinsi Kalimantan Utara" => ["Bulungan", "Kota Tarakan", "Nunukan", "Malinau", "Tana Tidung"],
        "Provinsi Sulawesi Utara" => ["Kota Manado", "Kota Bitung", "Kepulauan Sangihe", "Minahasa", "Bolaang Mongondow", "Minahasa Utara", "Minahasa Selatan", "Kota Tomohon", "Kepulauan Talaud", "Minahasa Tenggara", "Kota Kotamobagu", "Bolaang Mongondow Utara", "Bolaang Mongondow Timur", "Kep. Siau Tagulandang Biaro", "Bolaang Mongondow Selatan"],
        "Provinsi Sulawesi Tengah" => ["Kota Palu", "Buol", "Donggala", "Poso", "Banggai", "Banggai Kepulauan", "Tojo Una-Una", "Toli-Toli", "Parigi Moutong", "Morowali", "Sigi", "Banggai Laut", "Morowali Utara"],
        "Provinsi Sulawesi Tenggara" => ["Kota Kendari", "Konawe", "Kolaka", "Muna", "Buton", "Konawe", "Bombana", "Wakatobi", "Kolaka Utara", "Kota Bau-bau", "Buton Utara", "Kolaka Timur", "Konawe Kepulauan", "Muna Barat", "Konawe Utara", "Buton Tengah", "Buton Selatan"],
        "Sulawesi Selatan" => ["Kota Makasar", "Kota Pare-Pare", "Tana Toraja", "Pinrang", "Enrekang", "Sidenreng Rappang", "Pangkajene Kepulauan", "Maros", "Gowa", "Takalar", "Jeneponto", "Bantaeng", "Bulukumba", "Selayar", "Sinjai", "Bone", "Wajo", "Luwu", "Luwu Utara", "Soppeng", "Barru", "Luwu Timur", "Kota Palopo"],
        "Gorontalo" => ["Kota Gorontalo", "Gorontalo", "Boalemo", "Bone Bolango", "Pohuwato"],
        "Sulawesi Barat" => ["Mamuju", "Mamuju Utara", "Majene", "Polewali Mandar", "Mamasa", "Mamuju Tengah"],
        "Bali" => ["Kota Denpasar", "Buleleng", "Jembrana", "Badung", "Tabanan", "Gianyar", "Klungkung", "Bangli", "Karang Asem"],
        "Nusa Tenggara Barat" => ["Kota Mataram", "Lombok Barat", "Lombok Tengah", "Lombok Timur", "Sumbawa", "Dompu", "Bima", "Sumbawa Barat", "Kota Bima", "Lombok Utara"],
        "Nusa Tenggara Timur" => ["Kota Kupang", "Sumba Barat", "Sumba Timur", "Manggarai", "Sikka", "Ngada", "Ende", "Flores Timur", "Kupang", "Timor Tengah Selatan", "Timor Tengah Utara", "Belu", "Alor", "Lembata", "Manggarai Barat", "Rote Ndao", "Malaka", "Manggarai Timur", "Nagekeo", "Sabu Raijua", "Sumba Barat Daya", "Sumba Tengah"],
        "Maluku" => ["Kota Ambon", "Maluku Tengah", "Maluku Tenggara", "Maluku Tenggara Barat", "Buru", "Seram Bagian Timur", "Seram Bagian Barat", "Kepulauan Aru", "Buru Selatan"],
        "Maluku Utara" => ["Kota Ternate", "Kota Tidore Kepulauan", "Halmahera Utara", "Halmahera Tengah", "Halmahera Barat", "Halmahera Selatan", "Halmahera Timur", "Kepulauan Sula", "Pulau Morotai", "Pulau Taliabu"],
        "Papua" => ["Kota Jayapura", "Jayapura", "Biak Numfor", "Sarmi", "Keerom", "Boven Digoel", "Merauke", "Jayawijaya", "Paniai", "Kepulauan Yapen", "Waropen", "Asmat", "Mappi", "Mimika", "Nabire", "Pegunungan Bintang", "Puncak Jaya", "Tolikara", "Yahukimo", "Supiori", "Deiyai", "Dogiyai", "Intan Jaya", "Lanny Jaya", "Mamberamo Raya", "Mamberamo Tengah", "Nduga", "Puncak", "Yalimo"],
        "Papua Barat" => ["Kota Sorong", "Sorong", "Sorong Selatan", "Kaimana", "Manokwari", "Raja Ampat", "Teluk Bintuni", "Teluk Wondama", "Fak-Fak", "Manokwari Selatan", "Tambrauw", "Maybrat", "Pegunungan Arfax"]
    ];
}

function getGenders()
{
    return [
        'male',
        'female'
    ];
}

function getReligions()
{
    return [
        'Islam',
        'Kristen Protestan',
        'Kristen Katolik',
        'Hindu',
        'Buddha',
        'Khonghucu',
        'Lainnya'
    ];
}

function getEducations()
{
    return [
        'SD',
        'SMP',
        'SMA/SMK',
        'D1',
        'D2',
        'D3',
        'D4',
        'S1',
        'S2',
        'S3'
    ];
}

function getJobs()
{
    return ["Arsitek", "Administratur", "Apoteker", "Akuntan", "Akuntan", "Astronaut", "Aktor", "Aktris", "Atlet", "Bidan", "Buruh", "Blogger", "Camat", "Calo", "Dokter", "Dosen", "Direktur", "Desainer", "Editor", "Fotografer", "Guru", "Gamer", "Guide", "Hakim", "Hacker", "Ilustrator", "Ilmuwan", "Insinyur", "Inspektur", "Jaksa", "Jurnalis", "Kasir", "Kondektur", "Koki", "Kiai", "Komikus", "Karyawan", "Lurah", "Manajer", "Masinis", "Model", "Nelayan", "Novelis", "Nakhoda", "Operator", "Pastur", "Pegawai Negeri", "", "Pelukis", "Pendeta", "Penyanyi", "Pemahat", "Pengacara", "Perancang Grafis", "Politikus", "Programmer", "Peneliti", "Polisi", "Psikolog", "Psikiater", "Peretas", "Pengusaha", "Perminyakan", "Pramugari", "Programmer", "Perawat", "Penerjemah", "Pelaut", "Penulis", "Pilot", "Pramusaji", "Pramugara", "Presiden", "Penari", "Pemadam Kebakaran", "Pelayan", "Petani", "Raja", "Resepsionis", "Satpam", "Seniman", "Supir", "Sekretaris", "Selebritis", "Tengkulak", "Tukang", "TNI", "Ustad / Ulama", "Wartawan", "Wiraswastawan", "Wirausahawan", "Youtubers", "Lainnya"];
}

function getVisitType(){
    return [
        'Diantar',
        'Datang Sendiri'
    ];
}

function getServiceType(){
    return [
        'Regular',
        'VIP',
        'VVIP'
    ];
}