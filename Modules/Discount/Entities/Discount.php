<?php

namespace Modules\Discount\Entities;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'type', 'value', 'expire_date', 'number', 'first_limitation', 'payment_type', 'used_number'
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
     * The organizations that belong the discount.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organizations()
    {
        return $this->belongsToMany('Modules\Organization\Entities\Organization', 'organization_discount', 'discount_id', 'organization_id');
    }

    /**
     * The teachers that belong the discount.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany('Modules\Course\Entities\Teacher', 'teacher_discount', 'discount_id', 'teacher_id');
    }
}
