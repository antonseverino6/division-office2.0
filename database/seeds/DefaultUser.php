<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Anton Severino',
            'admin' => 1,
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'registered_by' => 1,
            'representative_id' => 1,
            'password' => Hash::make('testuser'),
        ]);
    }
}
