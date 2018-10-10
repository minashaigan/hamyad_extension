<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Exam\Entities\Exam::class, function (Faker $faker) {
    return [
        'name'              => $faker->name('exam'),
        'type'              => array_random([0, 1, 2]),
        'time_limitation'   => array_random([0, 1]),
        'time'              => '00:00:12',
        'question_number'   => random_int(0, 20),
        'category_id'       => array_random([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
    ];
});

$factory->define(\Modules\Exam\Entities\Question::class, function () {
   return [
       'description'        => 'ask questions every morning as much as you can',
       'type'               => 0,
       'score'              => random_int(5, 10),
       'exam_id'            => array_random([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
   ];
});
