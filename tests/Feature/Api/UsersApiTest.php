<?php

namespace Tests\Feature\Api;

use \PassportTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UsersApiTest extends PassportTestCase
{
    use RefreshDatabase;

    /**
     * Test REST API users index
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/users');
        $response->assertStatus(200)->assertJsonStructure([
            'success',
            'record_count',
            'data' => [
                'id',
                'name',
                'email',
                'admin',
                'email_verified_at',
                'created_at',
                'updated_at'
            ],
            'message'
        ]);
    }

    /**
     * Test REST API users me
     *
     * @return void
     */
    public function testMe()
    {
        $response = $this->get('/api/me');
        $response->assertStatus(200)->assertJsonStructure([
            'success',
            'record_count',
            'data' => [
                'id',
                'name',
                'email',
                'admin',
                'email_verified_at',
                'created_at',
                'updated_at'
            ],
            'message'
        ]);
    }


    /**
     * Test REST API users show
     *
     * @return void
     */
    public function testShow()
    {
        $user = factory(User::class)->create();

        $response = $this->get('/api/users/' . $user->id);
        $response->assertStatus(200)->assertJsonStructure([
            'success',
            'record_count',
            'data' => [
                'id',
                'name',
                'email',
                'admin',
                'email_verified_at',
                'created_at',
                'updated_at'
            ],
            'message'
        ]);
    }
}
