<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sleep;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
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
     * @param CsvImportRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function parseImport(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();

        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }

        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, 5);

            $csv_data_file = CsvData::create([
                'user_id' => Auth::id(),
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('import_fields', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));
    }

    /**
     * Process the CSV import
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $sleep = new Sleep();
            $sleep['user_id'] = Auth::id();
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {
                    $field = $request->fields[$field];
                    $value = $row[$field];
                    $sleep->$field = $sleep->validate($field, $value);
                } else {
                    $field = $request->fields[$index];
                    $value = $row[$field];
                    $sleep->$field = $sleep->validate($field, $value);
                }
            }
            $sleep->save();
        }

        return view('import_success');
    }
}
