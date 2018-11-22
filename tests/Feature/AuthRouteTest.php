<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AuthRouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that guests get routed to login
     *
     * @return void
     */
    public function testGuestRoutedToLogin()
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');

        $response = $this->get('/import');
        $response->assertRedirect('/login');
    }

    /**
     * Test login routing
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('login');
        $this->assertAuthenticated();
        $response->assertRedirect('/home');
    }
}
