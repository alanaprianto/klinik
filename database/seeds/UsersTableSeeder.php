<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = ['email' => 'admin@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'admin'];
        $loket = ['email' => 'loket@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'loket'];
        $admin_loket = ['email' => 'admin_loket@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'admin_loket'];
        $poli_umum = ['email' => 'poli_umum@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'poli_umum'];
        $admin_poli_umum = ['email' => 'admin_poli_umum@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'admin_poli_umum'];
        $poli_anak = [ 'email' => 'poli_anak@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'poli_anak'];
        $admin_poli_anak = [ 'email' => 'admin_poli_anak@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'admin_poli_anak'];
        $kasir = ['email' => 'kasir@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'kasir'];
        $admin_kasir = ['email' => 'admin_kasir@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'admin_kasir'];
        $apotek = ['email' => 'apotek@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'apotek'];
        $admin_apotek = ['email' => 'admin_apotek@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'admin_apotek'];
        $penata_jasa = ['email' => 'penata_jasa@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'penata_jasa'];

        \Illuminate\Support\Facades\DB::table('users')->insert([$admin, $loket, $admin_loket ,$poli_umum, $admin_poli_umum ,$poli_anak ,$admin_poli_anak ,$kasir,$admin_kasir ,$apotek, $admin_apotek, $penata_jasa]);
    }
}
