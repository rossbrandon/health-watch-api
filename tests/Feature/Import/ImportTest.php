<?php

namespace Tests\Feature\Import;

use Tests\TestCase;
use App\User;

class ImportTest extends TestCase
{
    /**
     * Test import controller index route
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

    /**
     * Test import parse processor
     *
     * @return void
     */
    public function testProcessImport()
    {

    }
}
