<?php

namespace Modules\Proficiency\Entities;

use Illuminate\Database\Eloquent\Model;

class Proficiency extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon'
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
     * The categories that belong the proficiency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('Modules\Course\Entities\Category', 'category_proficiency', 'proficiency_id', 'category_id');
    }

    /**
     * The skills that belong the proficiency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany('Modules\Skill\Entities\Skill', 'proficiency_skill', 'proficiency_id', 'skill_id');
    }

    /**
     * The courses that belong the proficiency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany('Modules\Course\Entities\Course', 'course_proficiency', 'proficiency_id', 'course_id');
    }

    /**
     * The teachers that belong the proficiency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany('Modules\Course\Entities\Teacher', 'teacher_proficiency', 'proficiency_id', 'teacher_id');
    }
}
