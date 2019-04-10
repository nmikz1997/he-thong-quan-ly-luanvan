<?php

use Illuminate\Database\Seeder;

class HoidongTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$dsLuanvan = DB::table('luanvan')->pluck('id');
    	$vaitro = [1,2,3];
    	$faker = Faker\Factory::create('vi_VN');

    	for($i = 0; $i<= sizeof($dsLuanvan) ; $i++){
    		$luanvan_id = $dsLuanvan[$i];
    		$dsCanbo = DB::table('canbo')->pluck('id')->toArray();
    		for($j = 1; $j<= 3; $j++){
    			$canbo_id = $faker->randomElement($dsCanbo);
    			DB::table('hoidongluanvan')->insert([
    				'luanvan_id' => $luanvan_id,
    				'canbo_id' => $canbo_id,
    				'vaitro' => $j,
    				'diem' => $faker->numberBetween($min = 4, $max = 10)
    			]);
    			$key = array_search($canbo_id, $dsCanbo);
    			array_splice($dsCanbo, $key, 1);
    		}

    	}
    }
}
