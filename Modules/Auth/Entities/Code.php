<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'user_temporary_codes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Get the user that owns the code.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');

    }
}
