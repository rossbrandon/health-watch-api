<?php

namespace Tests\Feature\Import;

use App\User;
use App\Sleep;
use App\Imports\SleepImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

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
     * Test import parser
     *
     * @return void
     */
    public function testParseImportError()
    {
        Session::start();
        $this->withoutMiddleware();
        Excel::fake();

        $file = UploadedFile::fake()->create('test_sleep.csv', 64);
        $response = $this->actingAs($this->user)->post(
            '/import_parse',
            array(
                '_token' => csrf_token(),
                'csv_file' => $file,
                'header' => true
            )
        );

        $response->assertViewIs('error');
    }

    /**
     * Test Sleep Import
     *
     * @return void
     */
    public function testSleepImportModel()
    {
        $sleep = factory(Sleep::class)->create();
        $this->actingAs($sleep->user);
        $sleepImport = new SleepImport();
        $data = $sleepImport->model($sleep->getAttributes());
        $this->assertEquals($sleep->user->id, $data->getAttributeValue('user_id'));
    }
}
