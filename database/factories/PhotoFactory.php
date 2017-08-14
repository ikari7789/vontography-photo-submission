<?php

use Faker\Generator as Faker;

$factory->define(App\Photo::class, function (Faker $faker) {
    static $user;

    return [
        'user_id' => $user ?: factory(App\User::class)->create()->id,
        'title' => $faker->title,
        'filepath' => $faker->image,
        'url' => $faker->imageUrl,
        'location' => $faker->city,
        'featuring' => $faker->name,
        'comment' => $faker->text,
    ];
});
