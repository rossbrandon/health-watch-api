<?php

namespace Tests\Feature\Api\Users;

use Tests\Feature\Api\UserApiTestCase;

class UsersApiTest extends UserApiTestCase
{
     /**
     * Test REST API users index
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/users');
        $response->assertStatus(403)->assertJsonStructure([
            'success',
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
        $response = $this->get('/api/users/' . $this->user->id);
        $response->assertStatus(200)->assertJsonStructure([
            'success',
            'record_count',
            'data' => [
                'id',
                'name',
                'email',
                'admin',
                'created_at',
                'updated_at'
            ],
            'message'
        ]);
    }
}
