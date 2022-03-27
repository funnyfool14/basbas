<?php

use Illuminate\Database\Seeder;

class FriendTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 9; $i <= 12; $i++) {
            DB::table('friends')->insert([
            'user_id' => '8',
            'friend_id' => $i,
            'accept' => '1',
            ]);
        }
    }
}
