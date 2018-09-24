<?php

namespace Modules\Exam\Entities;

use Modules\Course\Entities\Course;

class CourseExam extends Course
{
    protected $table = 'courses';

    /**
     * The exams that belong the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function exams()
    {
        return $this->belongsToMany('Modules\Exam\Entities\Exam', 'course_exam', 'course_id', 'exam_id');
    }
}
