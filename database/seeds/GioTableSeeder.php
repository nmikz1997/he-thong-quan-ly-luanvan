<?php

use Illuminate\Database\Seeder;

class GioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gio')->insert([
	        ['giobatdau'=>'07:15:00'],
	        ['giobatdau'=>'08:00:00'],
	        ['giobatdau'=>'08:45:00'],
	        ['giobatdau'=>'09:30:00'],
	        ['giobatdau'=>'10:15:00'],
	        ['giobatdau'=>'13:15:00'],
	        ['giobatdau'=>'14:00:00'],
	        ['giobatdau'=>'14:45:00'],
	        ['giobatdau'=>'15:30:00'],
	        ['giobatdau'=>'16:15:00']
        ]);
    }
}
