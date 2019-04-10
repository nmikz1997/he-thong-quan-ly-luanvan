<?php

use Illuminate\Database\Seeder;

class DetaidangkyTableSeeder extends Seeder
{
	public function run()
	{
		$dsSinhVien = ['B1507129','B1507130','B1507131','B1507132'];
		$dsdetai	= [1,2,3,4,5,6];
		$faker = Faker\Factory::create('vi_VN');
		for($i=0; $i <= 10; $i++){
			DB::table('detaidangky')->insert([
				'sinhvien_id' 	=> $faker->randomElement($dsSinhVien),
				'detai_id'		=> $faker->randomElement($dsdetai),
				'xacnhan'		=> 0
			]);
		}
	}
}
