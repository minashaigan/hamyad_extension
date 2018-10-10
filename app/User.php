<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Authenticatable implements AuthenticatableContract, AuthorizableContract
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'about', 'birth_date', 'username', 'password', 'telephone', 'phone', 'join_date', 'address', 'image', 'linkedin', 'melli_code'
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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the codes for the user.
     */
    public function codes()
    {
        return $this->hasMany('Modules\Auth\Entities\Code');
    }

    /**
     * The courses that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany('Modules\Course\Entities\Course', 'user_course', 'user_id', 'course_id');
    }

    /**
     * The sections that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sections()
    {
        return $this->belongsToMany('Modules\Course\Entities\Section', 'user_section', 'user_id', 'section_id');
    }

    /**
     * The exams that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function exams()
    {
        return $this->belongsToMany('Modules\Exam\Entities\Exam', 'user_exam', 'user_id', 'exam_id');
    }

    /**
     * The questions that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany('Modules\Exam\Entities\Question', 'user_question', 'user_id', 'question_id');
    }

    /**
     * The favorites that belong the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany('Modules\Course\Entities\Course', 'favorites', 'user_id', 'course_id');
    }
}
