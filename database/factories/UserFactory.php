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

use Faker\Generator as Faker;

$factory->define(App\Models\UserRole::class, function(Faker $faker) {
    return [
        'name' => $faker->name
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker $faker) {

    return [
        'username' => $faker->userName,
        'name' => $faker->name,
        'avatar' => $faker->image(),
        'password' => bcrypt($faker->password),
        'role' => function() {
            return factory('App\Models\UserRole')->create()->id;
        },
        'remember_token' => str_random(10),
    ];
});
