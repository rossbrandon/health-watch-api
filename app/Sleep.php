<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Emoji;

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

    /**
     * Foreign key for User object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Set composite key for saving data
     *
     * @return Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query->where('user_id', '=', $this->getAttribute('user_id'));
        $query->where('in_bed_at', '=', $this->getAttribute('in_bed_at'));
        return $query;
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
            case 'duration':
                $validatedData = $this->convertToTime($value);
                break;
            case 'asleep':
                $validatedData = $this->convertToTime($value);
                break;
            case 'time_awake_in_bed':
                $validatedData = $this->convertToTime($value);
                break;
            case 'fell_asleep_in':
                $validatedData = $this->convertToTime($value);
                break;
            case 'quality_sleep':
                $validatedData = $this->convertToTime($value);
                break;
            case 'deep_sleep':
                $validatedData = $this->convertToTime($value);
                break;
            case 'heartrate':
                $validatedData = $this->convertToInteger($value);
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
     * Convert a string to a time format
     *
     * @param string $value
     * @return string
     */
    private function convertToTime($value)
    {
        return date('H:i:s', strtotime($value));
    }

    /**
     * Convert string to integer
     *
     * @param string $value
     * @return integer
     */
    private function convertToInteger($value)
    {
        return (integer) $value;
    }

    /**
     * Convert emoji values to text
     *
     * @param $value
     * @return string
     */
    private function getConvertedTag($value)
    {
        $emojis = Emoji\detect_emoji($value);
        $count = count($emojis);
        $convertedTag = '';

        foreach ($emojis as $emoji) {
            switch ($emoji['short_name']) {
                case "coffee":
                    $convertedTag .= 'Drank Coffee';
                    break;
                case "wine_glass":
                    $convertedTag .= 'Drank Alcohol';
                    break;
                case "pill":
                    $convertedTag .= 'Took Sleep Aid';
                    break;
                case "woman-running":
                    $convertedTag .= 'Worked Out';
                    break;
                case "grinning":
                    $convertedTag .= 'Good Day';
                    break;
                case "hankey":
                    $convertedTag .= 'Bad Day';
                    break;
                case "sleeping":
                    $convertedTag .= 'Tired';
                    break;
                case "sneezing_face":
                    $convertedTag .= 'Sick Day';
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
