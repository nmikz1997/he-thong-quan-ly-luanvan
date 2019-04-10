<?php

use Illuminate\Database\Seeder;

class HockiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nienkhoa')->insert([
            [
                'nambatdau'=>'2018',
                'hocki'=>'1'
            ],
            [
                'nambatdau'=>'2018',
                'hocki'=>'2'
            ],
        	[
        		'nambatdau'=>'2019',
        		'hocki'=>'1'
        	],
        	[
        		'nambatdau'=>'2019',
        		'hocki'=>'2'
        	]
        ]);
    }
}
