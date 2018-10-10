<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\Question;

class QuestionTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [

    ];

    /**
     * A Fractal transformer.
     *
     * @param Question $question
     *
     * @return array
     */
    public function transform(Question $question)
    {
        $exam = $question->exam()->first();
        
        return [
            'id'                    => $question['id'],
            'description'           => $question['description'],
            'type'                  => $question['type'],
            'link'                  => $question['link'],
            'file'                  => $question['file'],
            'image'                 => $question['image'],
            'exam_name'             => $exam['name'],
            'exam_time_limitation'  => $exam['time_limitation'],
            'exam_time'             => $exam['time'],
        ];
    }
    

}
