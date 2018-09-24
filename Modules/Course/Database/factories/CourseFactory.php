<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Course\Entities\Category::class, function (Faker $faker) {
   return [
       'name'           => $faker->name('category'),
       'icon'           => 'icon'
   ];
});

$factory->define(\Modules\Course\Entities\Teacher::class, function (Faker $faker) {
    return [
        'first_name'            => $faker->firstName,
        'last_name'             => $faker->lastName,
        'resume'                => 'resume_link',
        'image'                 => 'image',
        'email1'                => 'email',
        'username'              => str_random(10),
        'password'              => app('hash')->make('secret'),
        'melli_code'            => random_int(00000000000, 99999999999),
        'IBAN'                  => str_random(10),
        'join_date'             => '1397/1/1',
        'phone'                 => '09128354865',
        'purchase_partnership'  => 1
    ];
});

$factory->define(\Modules\Course\Entities\Course::class, function (Faker $faker) {
    return [
        'name'          => $faker->name,
        'image'         => $faker->image(),
        'description'   => str_random(10),
        'salable'       => 1,
        'coming_soon'   => 1,
        'category_id'   => random_int(1, 10),
        'teacher_id'    => random_int(1, 10),
    ];
});

$factory->define(\Modules\Course\Entities\SectionGroup::class, function (Faker $faker) {
    return [
        'name'          => $faker->name('section_group'),
        'order'         => random_int(1, 20),
        'course_id'     => random_int(1, 10),
    ];
});

$factory->define(\Modules\Course\Entities\Section::class, function (Faker $faker) {
    return [
        'name'          => $faker->name('section'),
        'description'   => $faker->text,
        'time'          => random_int(0, 99),
        'section_group_id'    => random_int(1, 10),
    ];
});

$factory->define(\Modules\Skill\Entities\Skill::class, function (Faker $faker) {
    return [
        'name'          => $faker->name('skill'),
    ];
});

