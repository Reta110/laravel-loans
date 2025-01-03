<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Loans;
use Faker\Generator as Faker;

$factory->define(Loans::class, function (Faker $faker) {

    return [
        'client' => $faker->word,
        'amount' => $faker->randomDigitNotNull,
        'percent' => $faker->randomDigitNotNull,
        'dues' => $faker->randomDigitNotNull,
        'finished' => $faker->word,
        'client_percents' => $faker->text,
        'user_id' => 1
    ];
});
