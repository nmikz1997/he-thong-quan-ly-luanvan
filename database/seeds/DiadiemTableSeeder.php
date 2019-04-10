<?php

use Illuminate\Database\Seeder;

class DiadiemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diadiem')->insert([
        	['id'=>'LT1', 'ten'=>'Phòng Lý Thuyết 1','tinhtrang'=>1],
        	['id'=>'LT4', 'ten'=>'Phòng Lý Thuyết 2','tinhtrang'=>0],
        	['id'=>'LT5', 'ten'=>'Phòng Lý Thuyết 3','tinhtrang'=>0]
        ]);
    }
}
