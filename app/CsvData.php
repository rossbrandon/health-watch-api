<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CsvData extends Model
{
    protected $table = 'csv_data';

    public $fillable = ['csv_filename', 'csv_header', 'csv_data'];
}
