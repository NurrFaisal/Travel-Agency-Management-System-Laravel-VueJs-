<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\model\Visa;
use Faker\Generator as Faker;

$factory->define(Visa::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone_number' => '01682814443',
        'date_of_birth' => $faker->date(),
        'pp_number' => 1231321,
        'no_of_books' => rand(1,10),
        'pp_issue_date' => $faker->date(),
        'pp_expire_date' => $faker->date(),
        'country' => 2,
        'type' => 2,
        'suplier' => 2,
        'reference' => 1,
        'net_price' => 800,
        'price' => 1000,
        'advance' => 500,
        'sales_person' => 3,
        'received_date' => $faker->date(),
        'payment_status' => 0,
        'state' => 2,
    ];
});
