<?php

namespace Modules\Course\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('user_course')->insert(['user_id' => 1, 'course_id' => 2, 'rate' => random_int(0, 9)]);
        DB::table('user_course')->insert(['user_id' => 1, 'course_id' => 3, 'rate' => random_int(0, 9)]);
        DB::table('user_course')->insert(['user_id' => 1, 'course_id' => 5, 'rate' => random_int(0, 9)]);
        DB::table('course_skill')->insert(['course_id' => 1, 'skill_id' => 2]);
        DB::table('course_skill')->insert(['course_id' => 1, 'skill_id' => 3]);
        DB::table('course_skill')->insert(['course_id' => 1, 'skill_id' => 5]);
    }
}
