<?php

use Faker\Generator as Faker;

$factory->define(Modules\Organization\Entities\Organization::class, function (Faker $faker) {
   return [
       'name'           => $faker->name,
       'logo'           => $faker->name('logo'),
       'subdomain'      => $faker->name('subdomain'),
       'email'          => $faker->email,
       'IBAN'           => $faker->name('IBAN'),
       'join_date'      => '1397/1/1',
       'username'       => str_random(10),
       'password'       => app('hash')->make('secret'),
       'manager_number' => random_int(0, 10),
       'manager_name'   => str_random(5)
   ];
});

