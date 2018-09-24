<?php

namespace Modules\Course\Entities;

use App\User;

class UserCourse extends User
{
    protected $table = 'users';
    
    /**
     * The courses that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany('Modules\Course\Entities\Course', 'user_course', 'user_id', 'course_id');
    }

    /**
     * The sections that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sections()
    {
        return $this->belongsToMany('Modules\Course\Entities\Section', 'user_section', 'user_id', 'section_id');
    }
}
