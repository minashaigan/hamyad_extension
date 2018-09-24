<?php

namespace Modules\Exam\Entities;

use App\User;

class UserExam extends User
{
    protected $table = 'users';

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
     * The answers that belong the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function answers()
    {
        return $this->belongsToMany('Modules\Exam\Entities\Answer', 'user_answer', 'user_id', 'answer_id');
    }
}
