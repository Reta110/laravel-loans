<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Deposit;
use Faker\Generator as Faker;

$factory->define(Deposit::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'inyection' => $faker->word,
        'amount' => $faker->randomDigitNotNull,
        'user_id' => 1
    ];
});
