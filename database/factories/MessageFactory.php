<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    $created_at = $faker->dateTimeBetween('-1 day');
    return [
        'user_id'    => $faker->randomDigit,
        'message'    => $faker->text(),
        'created_at' => $created_at,
        'updated_at' => $faker->dateTimeBetween($created_at),
    ];
});
