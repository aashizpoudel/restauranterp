<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        //
        'name' =>$faker->name(),
        'slug' =>$faker->word(),
        'status' =>$faker->randomElement($array=['0','1']),
        'is_offer'=>$faker->randomElement($array=['0','1'])
    ];
});
