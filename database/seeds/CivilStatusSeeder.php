<?php

use App\CivilStatus;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CivilStatus::create([
            'name' => 'Single'
        ]);

        CivilStatus::create([
            'name' => 'Married'
        ]);
    }
}
