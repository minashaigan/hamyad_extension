<?php

namespace Modules\Proficiency\Entities;

use Modules\Course\Entities\Course;

class CourseProficiency extends Course
{
    protected $table = 'courses';

    /**
     * The proficiencies that belong the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function proficiencies()
    {
        return $this->belongsToMany('Modules\Proficiency\Entities\Proficiency', 'course_proficiency', 'course_id', 'proficiency_id');
    }
}
