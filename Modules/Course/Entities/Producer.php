<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'logo', 'description', 'website', 'email', 'IBAN', 'join_date'
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
     * The courses that belongs to the producer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany('Modules\Course\Entities\Course', 'course_producer', 'producer_id', 'course_id');
    }
}
