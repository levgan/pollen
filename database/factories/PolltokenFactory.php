<?php

$factory->define(App\Polltoken::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "description" => $faker->name,
        "user_id" => factory('App\User')->create(),
        "token" => $faker->name,
        "poll_id" => factory('App\Poll')->create(),
    ];
});
