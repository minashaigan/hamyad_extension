<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'logo', 'description', 'subdomain', 'email', 'IBAN', 'join_date', 'username', 'password', 'phone', 'manager_number', 'manager_name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The users that belongs to the organization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_organization', 'organization_id', 'user_id');
    }
}
