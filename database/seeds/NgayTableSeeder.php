<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NgayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $lastNK = 4;
        DB::table('ngay')->insert([
        	['ngay' => Carbon::parse('2019-01-01'), 'nienkhoa_id' => $lastNK],
        	['ngay' => Carbon::parse('2019-01-02'), 'nienkhoa_id' => $lastNK],
        	['ngay' => Carbon::parse('2019-01-03'), 'nienkhoa_id' => $lastNK]
        ]);
    }
}
