<?php

namespace Modules\Skill\Entities;

use Modules\Course\Entities\Course;

class CourseSkill extends Course
{
    protected $table = 'courses';

    /**
     * The skills that belong the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany('Modules\Skill\Entities\Skill', 'course_skill', 'course_id', 'skill_id');
    }
}
