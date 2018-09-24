<?php

namespace Modules\Notification\Entities;

use App\User;

class UserNotification extends User
{
    protected $table = 'users';

    /**
     * The notifications that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notifications()
    {
        return $this->belongsToMany('Modules\Notification\Entities\Notification', 'user_notification', 'user_id', 'notification_id');
    }

}