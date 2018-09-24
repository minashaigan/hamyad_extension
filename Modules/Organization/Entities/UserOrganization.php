<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

class UserOrganization extends Model
{
    protected $table = 'users';

    /**
     * The organizations that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organizations()
    {
        return $this->belongsToMany('Modules\Organization\Entities\Organization', 'user_organization', 'user_id', 'organization_id');
    }
}