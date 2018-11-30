<?php

namespace App\Http\Controllers;

use App\Imports\SleepImport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('import');
    }

    /**
     * Parse the CSV import
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function parseImport()
    {
        try {
            $file = request()->file('csv_file');
            Excel::import(new SleepImport, $file);
        } catch (\Exception $e) {
            report($e);
            $error = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ];
            return view('error', ['error' => $error]);
        }

        return view('success');
    }
}
