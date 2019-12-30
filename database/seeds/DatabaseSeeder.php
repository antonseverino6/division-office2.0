<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(DefaultUser::class);
        $this->call(RepresentativeSeeder::class);
        $this->call(CivilStatusSeeder::class);
        $this->call(EmploymentStatusSeeder::class);
        $this->call(SubjectSeeder::class);
    }
}
