<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use LaraDev\Model;
use LaraDev\Categories;

$factory->define(Categories::class, function (Faker $faker) {

    $title = $faker->sentence(3);
    return [
        'title' => $title,
        'slug' => Str::slug($title)
    ];
});
