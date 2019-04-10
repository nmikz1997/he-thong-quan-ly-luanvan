<?php

use Illuminate\Database\Seeder;

class CanboTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = '123456';
        $faker = Faker\Factory::create('vi_VN');
        $arrBoMon = ['CNTT', 'THƯD', 'KTPM', 'TT&MTT', 'KHMT', 'HTTT'];
        $arrChucDanh = ['PGS. TS', 'TS', 'ThS'];
        $arrChucVu = ['GV', 'TK'];
        $dsCB= [];
        $users = [];

        for($i = 1; $i<=4; $i++){
            $mscb   = '0000'.($i+3);
            $ten    = $faker->name;
            $email  = $faker->bothify('????').$mscb.'@cit.ctu.edu.vn';
            $chucvu = $faker->randomElement($arrChucVu);

            array_push($dsCB, [
                'id'         => $mscb,
                'ten'        => $ten,
                'chucdanh'   => $faker->randomElement($arrChucDanh),
                'chucvu'     => $chucvu,
                'email'      => $email,
                'sdt'        => $faker->bothify('09########'),
                // 'password'=>md5($pass),
                'bomon_id'   => $faker->randomElement($arrBoMon)
            ]);

            array_push($users, [
                'username'  => $mscb,
                'password'  => bcrypt($pass),
                'level'     => $chucvu == 'TK' ? 2 : 1
            ]);

        }

    	DB::table('canbo')->insert([
    		[
                'id'=>'00001',
                'ten'=>'Nguyễn Văn A',
                'chucdanh'=>'ThS',
                'chucvu'=>'GV',
                'email'=>'nguyenvana@gmail.com',
                'sdt'=>'0912123112',
                'bomon_id'=>'CNTT'
            ],
    		[
                'id'=>'00002',
                'ten'=>'Nguyễn Văn B',
                'chucdanh'=>'TS',
                'chucvu'=>'TK',
                'email'=>'nguyenvanb@gmail.com',
                'sdt'=>'0912123333',
                'bomon_id'=>'CNTT'
            ],
    		[
                'id'=>'00003',
                'ten'=>'Nguyễn Văn C',
                'chucdanh'=>'PGS.TS',
                'chucvu'=>'GV',
                'email'=>'nguyenvanc@gmail.com',
                'sdt'=>'0912124444',
                'bomon_id'=>'CNTT'
            ]
    	]);

        DB::table('users')->insert([
            [
                'username'=>'00001',
                'password'=>bcrypt($pass),
                'level'=>'1'
            ],
            [
                'username'=>'00002',
                'password'=>bcrypt($pass),
                'level'=>'2'
            ],
            [
                'username'=>'00003',
                'password'=>bcrypt($pass),
                'level'=>'1'
            ],
        ]);
        DB::table('users')->insert($users);
        DB::table('canbo')->insert($dsCB);
        
    }
}
