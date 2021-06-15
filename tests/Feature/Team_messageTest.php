<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Team_message;

class Team_messageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user()
    {
        $team_message = Team_message::find(1);
        $response = $team_message->user();

        $this->assertSame('test',$response['firstName']);
    }

    /*public function test_profile()
    {
        $user = User::find(1);
        $response = $user->profile()->first();

        $this->assertSame('みっちゃん',$response['nickname']);
    }*/
}
