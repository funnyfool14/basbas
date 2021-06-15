<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\team;

class TeamTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_application()
    {
        $team = Team::find(1);

        $response = $team->application();

        $this->assertSame(1,$response['team_id']);
    }
}
