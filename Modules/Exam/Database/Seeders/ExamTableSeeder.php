<?php

namespace Modules\Exam\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\Question;

class ExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 exams using the course factory
        factory(Exam::class, 10)->create();
        // create 10 questions using the course factory
        factory(Question::class, 10)->create();
    }
}
