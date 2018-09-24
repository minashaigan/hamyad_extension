<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'user_teacher';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'body', 'is_reminder'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'deleted_at'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_message_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_message_id');
    }

    /**
     * The users that have the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
