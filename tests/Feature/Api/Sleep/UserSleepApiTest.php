<?php

namespace Tests\Feature\Api\Sleep;

use Tests\Feature\Api\UserApiTestCase;

class UserSleepApiTest extends UserApiTestCase
{
     /**
     * Test REST API users index
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/sleep');
        $response->assertStatus(200)->assertJsonStructure([
            'success',
            'record_count',
            'data' => [
                '*'  => [
                    'id',
                    'user_id',
                    'in_bed_at',
                    'until',
                    'duration',
                    'asleep',
                    'time_awake_in_bed',
                    'fell_asleep_in',
                    'quality_sleep',
                    'deep_sleep',
                    'heartrate',
                    'tags',
                    'notes',
                    'created_at',
                    'updated_at'
                ]
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
        $response = $this->get('/api/me/sleep');
        $response->assertStatus(200)->assertJsonStructure([
            'success',
            'record_count',
            'data' => [
                '*'  => [
                    'id',
                    'user_id',
                    'in_bed_at',
                    'until',
                    'duration',
                    'asleep',
                    'time_awake_in_bed',
                    'fell_asleep_in',
                    'quality_sleep',
                    'deep_sleep',
                    'heartrate',
                    'tags',
                    'notes',
                    'created_at',
                    'updated_at'
                ]
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
        $response = $this->get('/api/sleep/' . $this->sleepData->id);
        $response->assertStatus(200)->assertJsonStructure([
            'success',
            'record_count',
            'data' => [
                'id',
                'user_id',
                'in_bed_at',
                'until',
                'duration',
                'asleep',
                'time_awake_in_bed',
                'fell_asleep_in',
                'quality_sleep',
                'deep_sleep',
                'heartrate',
                'tags',
                'notes',
                'created_at',
                'updated_at'
            ],
            'message'
        ]);
    }
}
