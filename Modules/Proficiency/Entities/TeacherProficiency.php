<?php

namespace Modules\Proficiency\Entities;

use Modules\Course\Entities\Teacher;

class TeacherProficiency extends Teacher
{
    protected $table = 'teachers';

    /**
     * The proficiencies that belong the teacher.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function proficiencies()
    {
        return $this->belongsToMany('Modules\Proficiency\Entities\Proficiency', 'teacher_proficiency', 'teacher_id', 'proficiency_id');
    }
}
