<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'resume', 'linkedin', 'image', 'email1', 'email2', 'about', 'birth_date', 'username', 'password', 'melli_code', 'IBAN', 'education', 'work_experience', 'join_date', 'telephone', 'phone', 'address', 'purchase_partnership'
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
     * Get the courses for the teacher.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany('Modules\Course\Entities\Course');
    }


//    public function messages()
//    {
//        return $this->belongsToMany('App\User', 'user_teacher', 'teacher_id', 'user_id')
//            ->withPivot('id', 'parent_message_id', 'subject', 'body', 'is_reminder');
//    }

    public function getMessages()
    {
        return Message::with('children')->get();
        return Message::with(array('children'=>function($query){
            $query->select('id','subject','body', 'is_reminder');
        }))->get();
    }
}
