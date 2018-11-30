<?php

namespace Tests\Feature\Import;

use App\Imports\SleepImport;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportTest extends TestCase
{
    protected $rules;
    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->followingRedirects();
        $this->user = factory(User::class)->create();
    }

    /**
     * Test import controller index route
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->actingAs($this->user)->get('/');
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewIs('import');
    }

    /**
     * Test import parser
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function testParseImport()
    {
        Session::start();
        $this->withoutMiddleware();
        Excel::fake();

        $file = Storage::disk('public')->get('test_autosleep.csv');
        //$file = UploadedFile::fake()->create('test_sleep.csv', 64);
        $response = $this->actingAs($this->user)->post(
            '/import_parse',
            array(
                '_token' => csrf_token(),
                'csv_file' => $file,
                'header' => true
            )
        );

        $response->assertViewIs('success');
    }

    /**
     * Test Sleep Import
     *
     * @return void
     */
    public function testSleepImportModel()
    {
        $this->actingAs($this->user);
        $row = [
            'in_bed_at' => '2018-10-21 01:46:00',
            'until' => '2018-10-21 12:29:00',
            'duration' => '10:43',
            'asleep' => '8:53',
            'time_awake_in_bed' => '1:50',
            'fell_asleep_in' => '--',
            'quality_sleep' => '6:00',
            'deep_sleep' => '1:52',
            'heartrate' => '91',
            'tags' => '🍷',
            'notes' => ''
        ];
        $sleep = new SleepImport();
        $data = $sleep->model($row);
        $this->assertEquals($this->user->id, $data->getAttributeValue('user_id'));
    }

}
