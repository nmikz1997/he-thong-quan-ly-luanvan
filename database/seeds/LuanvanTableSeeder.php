<?php

use Illuminate\Database\Seeder;

class LuanvanTableSeeder extends Seeder
{

    public function run()
    {
        $dsSinhvien = DB::table('sinhvien')->pluck('id');
        $dsDetai = DB::table('detai')->pluck('id');
        $faker = Faker\Factory::create('vi_VN');

        for($i = 0; $i<= sizeof($dsSinhvien) ; $i++){
            DB::table('luanvan')->insert([
                'id' => $dsSinhvien[$i],
                'detai_id' => $faker->randomElement($dsDetai)
            ]);
        }
        
    }
}
