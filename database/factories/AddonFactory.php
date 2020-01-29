<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Add_on;
use Faker\Generator as Faker;

$factory->define(Add_on::class, function (Faker $faker) {
    return [
        //
        'name'=>$faker->name(),
        'slug'=>$faker->word(),
        'price'=>$faker->numberBetween($min= 30, $max=100),
        'status'=>$faker->randomElement($array=['0', '1'])

    ];
});
