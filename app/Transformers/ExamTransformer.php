<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Exam\Entities\Exam;

class ExamTransformer extends TransformerAbstract
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
     * @param Exam $exam
     *
     * @return array
     */
    public function transform(Exam $exam)
    {
        return [
            'id'                => $exam['id'],
            'name'              => $exam['name'],
            'type'              => $exam['type'],
            'time_limitation'   => $exam['time_limitation'],
            'time'              => $exam['time'],
            'category'          => $exam->category()->first()->name,
            'question_number'   => $exam['question_number']
        ];
    }

}
