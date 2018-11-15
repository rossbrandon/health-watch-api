<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
    protected $table = 'sleep';

    public $fillable = [
        'user_id',
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Validate fields
     *
     * @param string $field
     * @param string $value
     * @return string
     */
    public function validate($field, $value)
    {
        $validatedData = null;

        switch ($field) {
            case 'tags':
                $validatedData = $this->getConvertedTag($value);
                break;
            default:
                $validatedData = $this->validateNull($value);
        }

        return $validatedData;
    }

    /**
     * Validate null values
     *
     * @param string $value
     * @return string|null
     */
    private function validateNull($value)
    {
        return $value == '--' ? null : $value;
    }

    /**
     * Convert emoji values to text
     *
     * @param $value
     * @return string
     */
    private function getConvertedTag($value)
    {
        $elements = explode('♀️', $value);
        $count = count($elements);
        $convertedTag = '';

        foreach ($elements as $element) {
            switch ($element) {
                case "🍷":
                    $convertedTag .= 'Drank Alcohol';
                    break;
                case "💊":
                    $convertedTag .= 'Took Sleep Aid';
                    break;
                case "🏃‍":
                    $convertedTag .= 'Worked Out';
                    break;
                default:
                    $convertedTag .= '';
            }
            $lastIteration = !(--$count);
            if (!$lastIteration) {
                $convertedTag .= ',';
            }
        }

        return $convertedTag;
    }
}
