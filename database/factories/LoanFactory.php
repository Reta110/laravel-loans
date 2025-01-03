<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Loan;
use Faker\Generator as Faker;

$factory->define(Loan::class, function (Faker $faker) {

    return [
        'client' => $faker->word,
        'amount' => $faker->randomDigitNotNull,
        'percent' => $faker->randomDigitNotNull,
        'dues' => $faker->randomDigitNotNull,
        'finished' => 0,
        'client_percents' => $faker->text,
        'expires_at' => $faker->date('Y-m-d H:i:s'),
        'user_id' => 1
    ];
});
