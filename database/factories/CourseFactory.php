<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $categories_id = Category::all()->pluck('id')->toArray();
    $random_key = array_rand($categories_id);
    $user_id = User::all()->pluck('id')->toArray();
    $random_user = array_rand($user_id);
    return [
        'name' => $faker->name,
        'slug' => $faker->slug,
        'category_id' => $categories_id[$random_key],
        'image' => 'user.jpg',
        'video' => $faker->url,
        'description' => $faker->text($maxNbChars = 100)
    ];
});
