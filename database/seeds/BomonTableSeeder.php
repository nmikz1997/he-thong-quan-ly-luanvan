<?php

use Illuminate\Database\Seeder;

class BomonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bomon')->insert([
        	['id'=>'CNTT','ten'=>'Công nghệ thông tin'],
        	['id'=>'KHMT','ten'=>'Khoa học máy tính'],
            ['id'=>'KTPM','ten'=>'Kỹ thuật phần mềm'],
        	['id'=>'TT&MTT','ten'=>'Truyền thông và Mạng máy tính'],
        	['id'=>'HTTT','ten'=>'Hệ thống thông tin'],
        	['id'=>'THƯD','ten'=>'Tin học ứng dụng']
        ]);
    }
}
