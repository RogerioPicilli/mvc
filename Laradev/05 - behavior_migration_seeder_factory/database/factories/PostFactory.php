<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use LaraDev\Model;
use LaraDev\Post;
use LaraDev\Categories;

$factory->define(Post::class, function (Faker $faker) {

    $title = $faker->sentence(10);
    return [
       'title' => $title,
       'slug' => Str::slug($title),
       'subtitle' => $faker->sentence(10),
       'description' => $faker->paragraph(5),
       'publish_at' => $faker->dateTime(),
       'category' => function(){
           return factory(Categories::class)->create()->id;
       }
    ];
});
