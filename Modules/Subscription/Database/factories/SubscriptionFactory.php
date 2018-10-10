<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Subscription\Entities\Subscription::class, function (Faker $faker) {
    return [
        'month'           => array_random([1,3,6]),
        'price'           => random_int(100, 500)*100000
    ];
});

