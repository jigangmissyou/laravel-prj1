<?php

use App\Models\User;

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker $faker) {

    return [
        'username' => $faker->userName,
        'truename' => $faker->name,
        'password' => bcrypt('123456'),
        'email'=> $faker->email,
        'phone'=>$faker->phoneNumber,
        'sex'=>['Mr', 'Mrs'][rand(0,1)]
    ];
});
