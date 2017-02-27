function getCities(selected) {
    var province = new Array();
    province["ACEH"] = ["Kota Banda Aceh", "Kota Sabang", "Aceh Besar", "Pidie", "Aceh Utara", "Aceh Tengah", "Aceh Barat", "Aceh Selatan", "Aceh Timur", "Aceh Tenggara", "Simeule", "Aceh Singkil", "Bireuen", "Kota Lhokseumawe", "Aceh Tamiang", "Kota Langsa", "Aceh Barat Daya", "Gayo Lues", "Aceh Jaya", "Kota Subulussalam", "Nagan Raya", "Pidie Jaya", "Bener Meriah"],
        province["SUMATERA UTARA"] = ["Kota Medan", "Kota Binjai", "Kota Tanjung Balai", "Kota Tebing Tinggi", "Kota Pematang Siantar", "Kota Sibolga", "Kota Padang Sidempuan", "Deli Serdang", "Langkat", "Karo", "Simalungun", "Asahan", "Labuhan Batu", "Tapanuli Tengah", "Tapanuli Utara", "Tapanuli Selatan", "Nias", "Dairi", "Toba Samosir", "Mandailing Natal", "Serdang Bedagai", "Nias Selatan", "Pakpak Bharat", "Humbang Hasundutan", "Samosir", "Batu Bara", "Labuhanbatu Selatan", "Padang Lawas", "Labuhanbatu Utara", "Padang Lawas Utara"],
        province["SUMATERA BARAT"] = ["Kota Padang", "Kota Bukittinggi", "Kota Payakumbuh", "Kota Padang Panjang", "Kota Solok", "Kota Sawah Lunto", "Pasaman", "Agam", "Lima Puluh Koto", "Tanah Datar", "Solok", "Sawahlunto/Sijunjung", "Padang Pariaman", "Pesisir Selatan", "Solok Selatan", "Pasaman Barat", "Kota Pariaman", "Dharmas Raya", "Kepulauan Mentawai"],
        province["RIAU"] = ["Kota Pekanbaru", "Kota Dumai", "Bengkalis", "Kampar", "Indragiri Hulu", "Indragiri Hilir", "Kuantan Singingi", "Pelalawan", "Rokan Hilir", "Rokan Hulu", "Siak", "Kepulauan Meranti"],
        province["JAMBI"] = ["Kota Jambi", "Batang Hari", "Bungo", "Tebo", "Kerinci", "Merangin", "Sarolangun", "Tanjung Jabung Barat", "Tanjung Jabung Timur", "Muaro Jambi"],
        province["BENGKULU"] = ["Kota Bengkulu", "Bengkulu Utara", "Bengkulu Selatan", "Rejang Lebong", "Muko-muko", "Seluma", "Kaur", "Lebong", "Kepahiang", "Bengkulu Tengah"],
        province["SUMATERA SELATAN"] = ["Kota Palembang", "Banyuasin", "Musi Banyuasin", "Musi Rawas", "Ogan Komering Ilir", "Ogan Komering Ulu", "Muara Enim", "Lahat", "Ogan Komering Ulu Timur", "Ogan Komering Ulu Selatan", "Ogan ilir", "Kota Lubuk Linggau", "Kota Pagar Alam", "Kota Prabumulih", "Penukal Abab Lematang Ilir", "Musi Rawas Utara", "Empat Lawang"],
        province["LAMPUNG"] = ["Kota Bandar Lampung", "Lampung Utara", "Lampung Barat", "Lampung Tengah", "Lampung Selatan", "Kota Metro", "Tulang Bawang", "Tanggamus", "Way Kanan", "Lampung Timur", "Pesawaran", "Tulang Bawang Barat", "Mesuji", "Pringsewu"],
        province["BANGKA BELITUNG"] = ["Kota Pangkalpinang", "Bangka", "Belitung", "Bangka Tengah", "Bangka Barat", "Belitung Timur", "Bangka Selatan"],
        province["KEPULAUAN RIAU"] = ["Kota Tanjung Pinang", "Kota Batam", "Bintan", "Karimun", "Natuna", "Lingga", "Kepulauan Anambas"],
        province["JAWA BARAT"] = ["Kota Bandung", "Kota Bogor", "Kota Sukabumi", "Kota Cirebon", "Bekasi", "Karawang", "Purwakarta", "Subang", "Bogor", "Sukabumi", "Cianjur", "Bandung", "Garut", "Sumedang", "Tasikmalaya", "Ciamis", "Kuningan", "Cirebon", "Indramayu", "Majalengka", "Kota Bekasi", "Kota Depok", "Kota Cimahi", "Kota Tasikmalaya", "Kota Banjar", "Bandung Barat", "Pangandaran"],
        province["DKI JAKARTA"] = ["Jakarta Pusat", "Jakarta Barat", "Jakarta Selatan", "Jakarta Timur", "Jakarta Utara", "Kepulauan Seribu"],
        province["JAWA TENGAH"] = ["Kota Semarang", "Kota Tegal", "Kota Pekalongan", "Kota Salatiga", "Kota Magelang", "Kota Surakarta", "Semarang", "Kendal", "Demak", "Grobogan", "Pekalongan", "Batang", "Pemalang", "Tegal", "Brebes", "Banyumas", "Cilacap", "Banjarnegara", "Purbalingga", "Magelang", "Temanggung", "Wonosobo", "Purworejo", "Kebumen", "Pati", "Kudus", "Jepara", "Blora", "Sukoharjo", "Klaten", "Rembang", "Sragen", "Boyolali", "Karanganyar", "Wonogiri"],
        province["DI YOGYAKARTA"] = ["Kota Yogyakarta", "Bantul", "Sleman", "Kulon Progo", "Gunung Kidul"],
        province["JAWA TIMUR"] = ["Kota Surabaya", "Kota Malang", "Kota Kediri", "Kota Madiun", "Kota Blitar", "Kota Mojokerto", "Kota Pasuruan", "Kota Probolinggo", "Gresik", "Sidoarjo", "Mojokerto", "Jombang", "Bojonegoro", "Tuban", "Lamongan", "Madiun", "Magetan", "Ngawi", "Ponorogo", "Pacitan", "Kediri", "Nganjuk", "Blitar", "Tulungagung", "Trenggalek", "Malang", "Pasuruan", "Probolinggo", "Lumajang", "Bondowoso", "Situbondo", "Jember", "Banyuwangi", "Pamekasan", "Sampang", "Sumenep", "Bangkalan", "Kota Batu"],
        province["BANTEN"] = ["Kota Tangerang", "Kota Cilegon", "Serang", "Lebak", "Pandeglang", "Tangerang", "Kota Serang", "Kota Tangerang Selatan"],
        province["KALIMANTAN BARAT"] = ["Kota Pontianak", "Sambas", "Pontianak", "Sanggau", "Sintang", "Kapuas Hulu", "Ketapang", "Landak", "Bengkayang", "Melawi", "Sekadau", "Kota Singkawang", "Kayong Utara", "Kubu Raya"],
        province["KALIMANTAN TENGAH"] = ["Kota Palangka Raya", "Kotawaringin Barat", "Kapuas", "Kotawaringin Timur", "Barito Utara", "Barito Selatan", "Pulang Pisau", "Gunung Mas", "Sukamara", "Lamandau", "Katingan", "Seruyan", "Murung Raya", "Barito Timur"],
        province["KALIMANTAN SELATAN"] = ["Kota Banjarmasin", "Banjar", "Hulu Sungai Utara", "Hulu Sungai Tengah", "Hulu Sungai Selatan", "Kota Baru", "Barito Kuala", "Tapin", "Tabalong", "Tanah Laut", "Kota Banjar Baru", "Tanah Bumbu", "Balangan"],
        province["KALIMANTAN TIMUR"] = ["Kota Samarinda", "Kota Balikpapan", "Kutai Kartanegara", "Berau", "Paser", "Kota Bontang", "Kutai Timur", "Kutai Barat", "Penajam Paser Utara", "Mahakam Ulu"],
        province["Provinsi Kalimantan Utara"] = ["Bulungan", "Kota Tarakan", "Nunukan", "Malinau", "Tana Tidung"],
        province["Provinsi Sulawesi Utara"] = ["Kota Manado", "Kota Bitung", "Kepulauan Sangihe", "Minahasa", "Bolaang Mongondow", "Minahasa Utara", "Minahasa Selatan", "Kota Tomohon", "Kepulauan Talaud", "Minahasa Tenggara", "Kota Kotamobagu", "Bolaang Mongondow Utara", "Bolaang Mongondow Timur", "Kep. Siau Tagulandang Biaro", "Bolaang Mongondow Selatan"],
        province["Provinsi Sulawesi Tengah"] = ["Kota Palu", "Buol", "Donggala", "Poso", "Banggai", "Banggai Kepulauan", "Tojo Una-Una", "Toli-Toli", "Parigi Moutong", "Morowali", "Sigi", "Banggai Laut", "Morowali Utara"],
        province["Provinsi Sulawesi Tenggara"] = ["Kota Kendari", "Konawe", "Kolaka", "Muna", "Buton", "Konawe", "Bombana", "Wakatobi", "Kolaka Utara", "Kota Bau-bau", "Buton Utara", "Kolaka Timur", "Konawe Kepulauan", "Muna Barat", "Konawe Utara", "Buton Tengah", "Buton Selatan"],
        province["Sulawesi Selatan"] = ["Kota Makasar", "Kota Pare-Pare", "Tana Toraja", "Pinrang", "Enrekang", "Sidenreng Rappang", "Pangkajene Kepulauan", "Maros", "Gowa", "Takalar", "Jeneponto", "Bantaeng", "Bulukumba", "Selayar", "Sinjai", "Bone", "Wajo", "Luwu", "Luwu Utara", "Soppeng", "Barru", "Luwu Timur", "Kota Palopo"],
        province["Gorontalo"] = ["Kota Gorontalo", "Gorontalo", "Boalemo", "Bone Bolango", "Pohuwato"],
        province["Sulawesi Barat"] = ["Mamuju", "Mamuju Utara", "Majene", "Polewali Mandar", "Mamasa", "Mamuju Tengah"],
        province["Bali"] = ["Kota Denpasar", "Buleleng", "Jembrana", "Badung", "Tabanan", "Gianyar", "Klungkung", "Bangli", "Karang Asem"],
        province["Nusa Tenggara Barat"] = ["Kota Mataram", "Lombok Barat", "Lombok Tengah", "Lombok Timur", "Sumbawa", "Dompu", "Bima", "Sumbawa Barat", "Kota Bima", "Lombok Utara"],
        province["Nusa Tenggara Timur"] = ["Kota Kupang", "Sumba Barat", "Sumba Timur", "Manggarai", "Sikka", "Ngada", "Ende", "Flores Timur", "Kupang", "Timor Tengah Selatan", "Timor Tengah Utara", "Belu", "Alor", "Lembata", "Manggarai Barat", "Rote Ndao", "Malaka", "Manggarai Timur", "Nagekeo", "Sabu Raijua", "Sumba Barat Daya", "Sumba Tengah"],
        province["Maluku"] = ["Kota Ambon", "Maluku Tengah", "Maluku Tenggara", "Maluku Tenggara Barat", "Buru", "Seram Bagian Timur", "Seram Bagian Barat", "Kepulauan Aru", "Buru Selatan"],
        province["Maluku Utara"] = ["Kota Ternate", "Kota Tidore Kepulauan", "Halmahera Utara", "Halmahera Tengah", "Halmahera Barat", "Halmahera Selatan", "Halmahera Timur", "Kepulauan Sula", "Pulau Morotai", "Pulau Taliabu"],
        province["Papua"] = ["Kota Jayapura", "Jayapura", "Biak Numfor", "Sarmi", "Keerom", "Boven Digoel", "Merauke", "Jayawijaya", "Paniai", "Kepulauan Yapen", "Waropen", "Asmat", "Mappi", "Mimika", "Nabire", "Pegunungan Bintang", "Puncak Jaya", "Tolikara", "Yahukimo", "Supiori", "Deiyai", "Dogiyai", "Intan Jaya", "Lanny Jaya", "Mamberamo Raya", "Mamberamo Tengah", "Nduga", "Puncak", "Yalimo"],
        province["Papua Barat"] = ["Kota Sorong", "Sorong", "Sorong Selatan", "Kaimana", "Manokwari", "Raja Ampat", "Teluk Bintuni", "Teluk Wondama", "Fak-Fak", "Manokwari Selatan", "Tambrauw", "Maybrat", "Pegunungan Arfax"]

    return province[selected];
}

$(document).ready(function () {
    $(document).on('change', '#province' ,function () {
        $this = $(this);
        var cities = getCities($this.val());
        $('#city').html('');
        $.each(cities, function (index, value) {
            var option = '<option value="' + value + '">' + value + '</option>'
            $('#city').append(option)
        })

    });
});