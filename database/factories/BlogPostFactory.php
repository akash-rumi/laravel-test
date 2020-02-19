<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogPost;
use Faker\Generator as Faker;

$factory->define(App\BlogPost::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'content' => $faker->realText(200, 2),
        'created_at' => $faker->dateTimeBetween('-1 years', 'now')
    ];
});
