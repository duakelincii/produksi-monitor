<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 50; $i++){

    		DB::table('product')->insert([
    			'nama' => "Bahan ".$faker->streetName,
    			'stock' => $faker->numberBetween(100,1000),
    			'harga_beli' => $faker->numberBetween(100000,100000000),
    			'harga_jual' => $faker->numberBetween(100000,100000000),
                'status'   => 'ready',
                'created_at'=> Carbon::now(),
    		]);

    	}
    }
}
