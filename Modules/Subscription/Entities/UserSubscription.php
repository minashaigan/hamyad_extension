<?php

namespace Modules\Subscription\Entities;

use App\User;

class UserSubscription extends User
{
    protected $table = 'users';

    /**
     * The subscriptions that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscriptions()
    {
        return $this->belongsToMany('Modules\Subscription\Entities\Subscription', 'user_subscription', 'user_id', 'subscription_id');
    }

}