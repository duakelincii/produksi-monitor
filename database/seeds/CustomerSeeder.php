<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 20; $i++){
 
    		DB::table('customer')->insert([
    			'nama' => $faker->name,
                'email'=> $faker->companyEmail,
    			'phone' => $faker->phoneNumber,
    			'alamat' => $faker->address,
                'created_at'=> Carbon::now()
    		]);
 
    	}
    }
}
