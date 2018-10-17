<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

$factory->define(App\Photo::class, function (Faker $faker) {
    static $user;

    $sentence = $faker->sentence(5);

    $photosDir = Storage::path('photos');

    Storage::makeDirectory($photosDir);

    $photo = $faker->image($photosDir);

    return [
        'user_id' => $user ?: factory(App\User::class)->create()->id,
        'title' => substr($sentence, 0, strlen($sentence) - 1),
        'social_handle' => $faker->userName,
        'filepath' => substr($photo, strpos($photo, 'photos')),
        'url' => $faker->imageUrl,
        'location' => $faker->city,
        'featuring' => $faker->name,
        'camera_metadata' => $faker->text,
        'comment' => $faker->text,
    ];
});
