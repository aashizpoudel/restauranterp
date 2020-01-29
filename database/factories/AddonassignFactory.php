<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Addons_Food;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Addons_Food::class, function (Faker $faker) {
    return [
        'food_id'=>$faker->numberBetween($max = 10 , $min = 1),
        'add_on_id'=>$faker->numberBetween($max = 10 , $min = 1),
    ];
});
