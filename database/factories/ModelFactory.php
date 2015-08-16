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

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => 'password',
        'is_admin' => false
    ];
});

$factory->define(App\Author::class, function ($faker) {
    return [
        'name' => $faker->unique()->name,
        'description' => $faker->text
    ];
});

$factory->define(App\Category::class, function ($faker) {
    return [
        'name' => $faker->unique()->word
    ];
});

$factory->define(App\Book::class, function ($faker) {
    return [
        'title' => $faker->sentence,
        'isbn' => $faker->unique()->isbn13,
        'description' => $faker->text,
        'pages' => rand(10, 1500),
        'publisher' => $faker->name,
        'published_date' => $faker->date,
        'price' => $faker->randomFloat(2, 1, 500),
        'image' => $faker->imageUrl(252, 378),
    ];
});
