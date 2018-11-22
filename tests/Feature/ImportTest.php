<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test home controller index route
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/');
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewIs('import');
    }
}
