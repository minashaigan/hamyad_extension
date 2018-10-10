<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'coming_soon', 'enable', 'file', 'useful_resources', 'price'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'deleted_at'
    ];

    /**
     * The users that have the course.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_course', 'course_id', 'user_id')
            ->withPivot('rate');
    }

    /**
     * Get the category that owns the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Modules\Course\Entities\Category', 'category_id');
    }

    /**
     * Get the section_groups for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function section_groups()
    {
        return $this->hasMany('Modules\Course\Entities\SectionGroup');
    }
    
    /**
     * Get the teacher that owns the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo('Modules\Course\Entities\Teacher', 'teacher_id');
    }

    /**
     * The producers that have the course.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function producers()
    {
        return $this->belongsToMany('Modules\Course\Entities\Producer', 'course_producer', 'course_id', 'producer_id');
    }

    /**
     * The skills that belong the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany('Modules\Skill\Entities\Skill', 'course_skill', 'course_id', 'skill_id');
    }

    /**
     * The users that belong to the course.
     */
    public function favorites()
    {
        return $this->belongsToMany('App\User', 'favorites', 'course_id', 'user_id');
    }
}
