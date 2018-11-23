<?php

namespace Tests\Feature\Import;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Tests\TestCase;
use App\User;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Support\Facades\Storage;

class ImportTest extends TestCase
{
    protected $rules;
    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->followingRedirects();
        $this->user = factory(User::class)->create();
        $this->rules = (new CsvImportRequest())->rules();
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
        $file = Storage::disk('public')->get('test_autosleep.csv');
        $response = $this->actingAs($this->user)->post('/import_parse', array('csv_file' => $file));
        $response->assertViewIs('import');
    }
}
