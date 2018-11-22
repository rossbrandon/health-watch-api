<?php

namespace Tests\Feature\Api;

use App\User;
use App\Sleep;

class NonAdminApiTestCase extends AbstractApiTestCase
{
    protected $user;
    protected $adminUser;
    protected $sleepData;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->states('user')->create();
        $this->adminUser = factory(User::class)->states('admin')->create();
        $this->sleepData = Sleep::create([
            'user_id' => $this->adminUser->id,
            'in_bed_at'=> date('Y-m-d H:i:s'),
            'until'=> date('Y-m-d H:i:s'),
            'duration'=> date('H:i:s'),
            'asleep'=> date('H:i:s'),
            'time_awake_in_bed'=> date('H:i:s'),
            'fell_asleep_in'=> date('H:i:s'),
            'quality_sleep'=> date('H:i:s'),
            'deep_sleep'=> date('H:i:s'),
            'heartrate'=> 123,
            'tags'=> '',
            'notes'=> 'Lorem dummy text',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ]);
        $token = $this->user->createToken('TestAdminToken', $this->scopes)->accessToken;
        $this->headers['Accept'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer ' . $token;
    }
}
