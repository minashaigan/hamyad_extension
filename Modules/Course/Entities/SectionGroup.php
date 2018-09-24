<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;

class SectionGroup extends Model
{
    protected $table = 'section_groups';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'order'
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
     * Get the course that owns the section_group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('Modules\Course\Entities\Course', 'course_id');
    }

    /**
     * Get the sections for the section_group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany('Modules\Course\Entities\Section');
    }
}