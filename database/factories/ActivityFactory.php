<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'amount' => $faker->randomDigitNotNull,
        'earnings' => $faker->randomDigitNotNull,
        'client_earnings' => $faker->text,
        'due' => $faker->randomDigitNotNull,
        'date' => $faker->word
        'activity_type_id' => 1
    ];
});
