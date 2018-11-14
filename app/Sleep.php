<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
    protected $table = 'sleep';

    public $fillable = [
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
        'notes'
    ];
}
