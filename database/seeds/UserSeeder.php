<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Puput indah Pratama',
            'username' => 'puput',
            'email' => 'puput@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'staff'
        ]);
        DB::table('users')->insert([
            'name' => 'Rizki akbar',
            'username' => 'rizki',
            'email' => 'rizki@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'manager'
        ]);
    }
}
