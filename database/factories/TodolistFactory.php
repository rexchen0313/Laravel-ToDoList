<?php

use Faker\Generator as Faker;
use App\Todolist;

$factory->define(Todolist::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(10),
        'content' => $faker->realText(200),
    ];
});
