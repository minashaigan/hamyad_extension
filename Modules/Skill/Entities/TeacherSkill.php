<?php

namespace Modules\Skill\Entities;

use Modules\Course\Entities\Teacher;

class TeacherSkill extends Teacher
{
    protected $table = 'teachers';

    /**
     * The skills that belong the teacher.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany('Modules\Skill\Entities\Skill', 'teacher_skill', 'teacher_id', 'skill_id');
    }
}
