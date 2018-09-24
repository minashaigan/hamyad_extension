<?php

namespace Modules\Discount\Entities;

use Modules\Course\Entities\Teacher;

class TeacherDiscount extends Teacher
{
    protected $table = 'teachers';

    /**
     * The discounts that belong the teacher.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function discounts()
    {
        return $this->belongsToMany('Modules\Discount\Entities\Discount', 'teacher_discount', 'teacher_id', 'discount_id');
    }
}
