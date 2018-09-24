<?php

namespace Modules\Discount\Entities;

use Modules\Organization\Entities\Organization;

class OrganizationDiscount extends Organization
{
    protected $table = 'organizations';

    /**
     * The discounts that belong the organization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function discounts()
    {
        return $this->belongsToMany('Modules\Discount\Entities\Discount', 'organization_discount', 'organization_id', 'discount_id');
    }
}