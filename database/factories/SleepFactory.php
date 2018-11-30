<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Sleep::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'in_bed_at' => '2018-10-21 01:46:00',
        'until' => '2018-10-21 12:29:00',
        'duration' => '10:43',
        'asleep' => '8:53',
        'time_awake_in_bed' => '1:50',
        'fell_asleep_in' => '1:37',
        'quality_sleep' => '6:00',
        'deep_sleep' => '1:52',
        'heartrate' => '91',
        'tags' => '😀😴🤧💩🏃‍♀️💊☕️🍷👨‍👩‍👦‍👦',
        'notes' => ''
    ];
});
