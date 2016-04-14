<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Article\Post::class, function (Faker\Generator $faker) {
    $body = $faker->paragraphs(3, true);
    return [
        'published_at' => $faker->dateTimeBetween('-6 years', '+2 weeks'),
        'slug' => $faker->slug,
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'markdown' => $body,
        'html' => $body,
    ];
});
