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
        $admin = ['name' => 'Admin', 'email' => 'admin@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'admin'];
        $loket = ['name' => 'Loket', 'email' => 'loket@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'loket'];
        $poli_umum = ['name' => 'poli_umum', 'email' => 'poli_umum@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'poli_umum'];
        $poli_anak = ['name' => 'poli_anak', 'email' => 'poli_anak@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'poli_anak'];
        $kasir = ['name' => 'Kasir', 'email' => 'kasir@klinik.com', 'password' => bcrypt('qwe123@@'), 'username' => 'kasir'];

        \Illuminate\Support\Facades\DB::table('users')->insert([$admin, $loket, $poli_umum, $poli_anak ,$kasir]);
    }
}
