<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Food;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Food::class, function (Faker $faker) {
    return [
        //
        'category_id'=>Category::inRandomOrder()->first()->id,
        'name'=>$faker->name(),
        'slug'=>$faker->word(),
        'components'=>$faker->sentence($nbWords = 6),
        'notes'=>$faker->sentence($nbWords=3),
        'description'=>$faker->text($maxNbChars= 255),
        'price'=>$faker->numberBetween($min= 100, $max = 1000),
        'vat'=>$faker->randomElement($array=['10%','15%']),
        'is_offer'=>$faker->randomElement($array=['0', '1']),
        'is_special'=>$faker->randomElement($array=['0', '1']),
        'status'=>$faker->randomElement($array=['0', '1'])
    ];
});
