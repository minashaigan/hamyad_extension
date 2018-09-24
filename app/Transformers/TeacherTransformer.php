<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Message;
use Modules\Course\Entities\Section;
use Modules\Course\Entities\Teacher;

class TeacherTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        
    ];

    /**
     * A Fractal transformer.
     * 
     * @param Teacher $teacher
     * 
     * @return array
     */
    public function transform(Teacher $teacher)
    {
        $courses = $teacher->courses()->get();

        $course_number = $teacher->courses()->count();

        // time
        $time = 0;
        foreach ($courses as $course) {
            $section_groups = $course->section_groups()->pluck('id')->toArray();
            $time += array_sum(Section::query()->whereIn('section_group_id', $section_groups)->pluck('time')->toArray());
        }

        // students
        $students = 0;
        foreach ($courses as $course) {
            $users_course = $course->users()->count();
            $students += $users_course;
        }

        // rate
        $sum = 0;
        $count = 0;
        $rate = 0;
        foreach ($courses as $course) {
            $sum += array_sum($course->users()->wherePivot('rate', '!=', null)->get()->pluck('pivot.rate')->toArray());
            $count += $course->users()->wherePivot('rate', '!=', null)->count();
            if($count){
                $rate = $sum/$count;
            }
        }

        return [
            'name'          => $teacher['first_name']." ".$teacher['last_name'],
            'image'         => $teacher['image'],
            'description'   => $teacher['description'],
            'students'      => $students,
            'rate'          => $rate,
            'time'          => $time,
            'course_number' => $course_number
        ];
    }
    
}
