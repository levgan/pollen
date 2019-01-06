<?php

$factory->define(App\Response::class, function (Faker\Generator $faker) {
    return [
        "user_id" => factory('App\User')->create(),
        "name" => $faker->name,
        "question_id" => factory('App\Question')->create(),
        "option_id" => factory('App\Option')->create(),
        "poll_id" => factory('App\Poll')->create(),
    ];
});
