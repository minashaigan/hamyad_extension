<?php

namespace Modules\Cooperate\Entities;

use Illuminate\Database\Eloquent\Model;

class Cooperate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'first_name', 'last_name', 'email', 'phone', 'resume', 'description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
}
