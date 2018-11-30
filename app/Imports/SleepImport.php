<?php

namespace App\Imports;

use App\Sleep;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class SleepImport implements ToModel, WithHeadingRow
{
    /**
     * Create Sleep model from CSV upload
     *
     * @param array $row
     * @return Sleep|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|null
     */
    public function model(array $row)
    {
        $sleep = new Sleep();
        $sleep['user_id'] = Auth::id();
        $sleep['in_bed_at'] = $sleep->validate($sleep['in_bed_at'], $row['in_bed_at']);
        $sleep['until'] = $sleep->validate($sleep['until'], $row['until']);
        $sleep['duration'] = $sleep->validate($sleep['duration'], $row['duration']);
        $sleep['asleep'] = $sleep->validate($sleep['asleep'], $row['asleep']);
        $sleep['time_awake_in_bed'] = $sleep->validate($sleep['time_awake_in_bed'], $row['time_awake_in_bed']);
        $sleep['fell_asleep_in'] = $sleep->validate($sleep['fell_asleep_in'], $row['fell_asleep_in']);
        $sleep['quality_sleep'] = $sleep->validate($sleep['quality_sleep'], $row['quality_sleep']);
        $sleep['deep_sleep'] = $sleep->validate($sleep['deep_sleep'], $row['deep_sleep']);
        $sleep['heartrate'] = $sleep->validate($sleep['heartrate'], $row['heartrate']);
        $sleep['tags'] = $sleep->validate($sleep['tags'], $row['tags']);
        $sleep['notes'] = $sleep->validate($sleep['notes'], $row['notes']);
        return $sleep;
    }
}
