<?php

use Illuminate\Database\Seeder;

class ThoigianhethongTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('thoigianhethong')->insert([
        	[
	        	'id'			=>'gvpost',
	        	'ten'			=>'giáo viên post đề tài',
	        	'thoigianmo'	=>'2019-02-12 00:00:00',
	        	'thoigiandong'	=>'2020-02-12 00:00:00'
	        ],
	        [
	        	'id'			=>'svdangky',
	        	'ten'			=>'sinh viên đăng ký đề tài',
	        	'thoigianmo'	=>'2019-02-12 00:00:00',
	        	'thoigiandong'	=>'2020-02-12 00:00:00'
	        ]
        ]);
    }
}
