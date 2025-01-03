<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Withdrawal;
use Faker\Generator as Faker;

$factory->define(Withdrawal::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'amount' => $faker->randomDigitNotNull,
        'user_id' => 1
    ];
});
