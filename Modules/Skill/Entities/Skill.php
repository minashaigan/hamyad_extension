<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The proficiencies that belong the skill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function proficiencies()
    {
        return $this->belongsToMany('Modules\Proficiency\Entities\Proficiency', 'proficiency_skill', 'skill_id', 'proficiency_id');
    }

    /**
     * The teachers that belong the skill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany('Modules\Course\Entities\Teacher', 'teacher_skill', 'skill_id', 'teacher_id');
    }

    /**
     * The users that belong the skill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_skill', 'skill_id', 'user_id');
    }
}
