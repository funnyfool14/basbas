<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_profile()
    {
        $user = User::find(1);
        $response = $user->profile()->first();

        $this->assertSame('みっちゃん',$response['nickname']);
    }

    /*public function testIndex()
    {
        $this->visit('/')
        ->see('>Bas×Bas');
    }*/

    public function test_get_shoes()
    {
        $user = User::find(1);
        $response = $user->get_shoes();

        $this->assertSame('adidas',$response['brand']);

    }
}