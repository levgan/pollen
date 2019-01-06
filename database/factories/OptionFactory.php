<?php

$factory->define(App\Option::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "description" => $faker->name,
        "value" => $faker->name,
    ];
});
