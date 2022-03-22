<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 16; $i <= 30; $i++) {
            DB::table('users')->insert([
            'firstName' => 'テスト',
            'lastName' => $i,
            'email' => 'test'. $i . '@test',
            'password' => bcrypt('qqqqqqqq')
            ]);
        }
	}
}
