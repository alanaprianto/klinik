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
        $this->call(RoleUsersTableSeeder::class);
        $this->call(HospitalTableSeeder::class);
        $this->call(PoliesTableSeeder::class);
        $this->call(StaffJobsTableSeeder::class);
        $this->call(StaffsTableSeeder::class);
        $this->call(DoctorPoliesSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(StaffAttachTableSeeder::class);
/*        $this->call(ProvinceTableSeeder::class);*/
        $this->call(DistributorTableSeeder::class);
    }
}
