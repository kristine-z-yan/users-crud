<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Role::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['role1', 'role2', 'role3', 'role4', 'role5']),
        'description' => $faker->realText($maxNbChars = 10),
    ];
});
