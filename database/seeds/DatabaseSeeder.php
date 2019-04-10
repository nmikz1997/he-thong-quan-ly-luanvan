<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BomonTableSeeder::class);
        $this->call(ThoigianhethongTableSeeder::class);
        $this->call(HockiTableSeeder::class);
        $this->call(GioTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CanboTableSeeder::class);
        $this->call(SinhvienTableSeeder::class);
        $this->call(DiadiemTableSeeder::class);
        $this->call(DetaiTableSeeder::class);
    }
}
