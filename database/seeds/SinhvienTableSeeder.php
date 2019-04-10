<?php

use Illuminate\Database\Seeder;

class SinhvienTableSeeder extends Seeder
{

    public function run()
    {
    	$lastNK = 4;
    	$khoa = 'K41';
    	$pass = '123123';
    	$faker = Faker\Factory::create('vi_VN');
    	$arrBoMon = ['CNTT', 'THƯD', 'KTPM', 'TT&MTT', 'KHMT', 'HTTT'];
    	$dsSV= [];
        $users = [];
    	for($i = 1; $i<=40; $i++){
    		$mssv 	= $faker->bothify('B150####');
    		$ten	= $faker->name;
    		$email 	= $faker->bothify('????').$mssv.'@student.ctu.edu.vn';

    		array_push($dsSV, [
    			'id'=>$mssv,
        		'ten'=>$ten,
        		'gioitinh'=>$faker->numberBetween(0,1),
        		'khoa'=>'K41',
        		'email'=>$email,
        		'SDT'=>$faker->bothify('09########'),
        		'bomon_id'=>$faker->randomElement($arrBoMon),
        		'nienkhoa_id'=>$lastNK
    		]);

            array_push($users, [
                'username' => $mssv,
                'password' => bcrypt($pass)
            ]);

    	}
        DB::table('users')->insert($users);
        DB::table('sinhvien')->insert($dsSV);
        
    }
}
