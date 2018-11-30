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
        $existingSleep = Sleep::where('user_id', Auth::id())
            ->where('in_bed_at', $row['in_bed_at'])
            ->get()
            ->first();

        $sleep = $existingSleep ? $existingSleep: new Sleep();
        $sleep['user_id'] = Auth::id();
        $sleep['in_bed_at'] = $sleep->validate('in_bed_at', $row['in_bed_at']);
        $sleep['until'] = $sleep->validate('until', $row['until']);
        $sleep['duration'] = $sleep->validate('duration', $row['duration']);
        $sleep['asleep'] = $sleep->validate('asleep', $row['asleep']);
        $sleep['time_awake_in_bed'] = $sleep->validate('time_awake_in_bed', $row['time_awake_in_bed']);
        $sleep['fell_asleep_in'] = $sleep->validate('fell_asleep_in', $row['fell_asleep_in']);
        $sleep['quality_sleep'] = $sleep->validate('quality_sleep', $row['quality_sleep']);
        $sleep['deep_sleep'] = $sleep->validate('deep_sleep', $row['deep_sleep']);
        $sleep['heartrate'] = $sleep->validate('heartrate', $row['heartrate']);
        $sleep['tags'] = $sleep->validate('tags', $row['tags']);
        $sleep['notes'] = $sleep->validate('notes', $row['notes']);
        $sleep->save();
        return $sleep;
    }
}
