<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Model;
use App\Post;
use App\Profile;
use App\Tag;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title=$faker->sentence();
    return [
        'title'=>$title,
        'content'=>$faker->paragraph(),
        'slug'=>strtolower(str_replace(' ','-',$title)),
        'category_id'=>Category::all()->random()->id,
        'user_id'=>User::all()->random()->id,
        'featured'=>$faker->randomElement(['1.png','2.png','3.jpg','4.jpg','5.jpg','6.jpg']),
    ];
});

$factory->define(Category::class, function (Faker $faker) {

    return [
      'name'=>$faker->word(),
    ];
});

$factory->define(Tag::class, function (Faker $faker) {

    return [
      'tag'=>$faker->word(),
    ];
});


$factory->define(Profile::class, function (Faker $faker) {

    return [
        'user_id'=>User::all()->random()->id,
        'about'=>$faker->paragraph(),
        'facebook'=>$faker->url,
        'youtube'=>$faker->url,
        'avatar'=>$faker->randomElement(['1.png','2.png','3.jpg','4.jpg','5.jpg','6.jpg']),
    ];
});



