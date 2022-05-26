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
            'role'     => 'super admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Puput indah Pratama',
            'username' => 'puput',
            'email' => 'puput@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'admisi'
        ]);
        DB::table('users')->insert([
            'name' => 'Rizki akbar',
            'username' => 'rizki',
            'email' => 'rizki@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'manager'
        ]);
        DB::table('users')->insert([
            'name' => 'Daniel Sabat',
            'username' => 'daniel',
            'email' => 'daniel@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'purchasing'
        ]);
        DB::table('users')->insert([
            'name' => 'Rizal Kocak',
            'username' => 'rizal',
            'email' => 'rizal@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'pengiriman'
        ]);
    }
}
