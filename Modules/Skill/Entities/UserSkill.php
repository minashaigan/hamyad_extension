<?php

namespace Modules\Skill\Entities;

use App\User;

class UserSkill extends User
{
    protected $table = 'users';

    /**
     * The skills that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany('Modules\Skill\Entities\Skill', 'user_skill', 'user_id', 'skill_id');
    }
}