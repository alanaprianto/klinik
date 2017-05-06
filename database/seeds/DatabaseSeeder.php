<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermsTableSeeder::class);
        $this->call(RoleUsersTableSeeder::class);
        $this->call(PermsRolesSeeder::class);
        $this->call(HospitalTableSeeder::class);
        $this->call(PoliesTableSeeder::class);
        $this->call(StaffJobsTableSeeder::class);
        $this->call(StaffsTableSeeder::class);
        $this->call(DoctorPoliesSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(StaffAttachTableSeeder::class);
        $this->call(DistributorTableSeeder::class);
        $this->call(InvetoryTableSeeder::class);
/*        $this->call(ProvinceTableSeeder::class);
        $this->call(Idc10TableSeeder1::class);
        $this->call(Idc10TableSeeder2::class);
        $this->call(Idc10TableSeeder3::class);
        $this->call(Idc10TableSeeder4::class);
        $this->call(Idc10TableSeeder5::class);
        $this->call(Idc10TableSeeder6::class);
        $this->call(Idc10TableSeeder7::class);*/
    }
}
